<template>
    <div class="row mb-3" v-can="permission + '.create'">
        <div class="col-12">
            <button class="btn btn-primary float-md-end" @click="create">
                <i class="bi bi-plus-lg"></i>
                Crear {{ title }}
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <SimplePaginatedTable
                :laravel-response="state.laravelResponse"
                :columns="columns"
                @change-page="index"
            >
                <template #actionTitle>Acciones</template>
                <template #name="{value, item}">
                    {{ value }}
                    <template v-if="item.deleted_at">
                        <br>
                        <span class="badge text-bg-danger" >Deshabilitado</span></template>
                    </template>
                <template #actions="{item, index}">
                    <button class="btn btn-secondary" title="Modificar" @click="edit(item, index)" v-can="permission + '.edit'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger ms-2" title="Eliminar" @click="destroy(item, index)" v-if="item.deleted_at == null" v-can="permission + '.destroy'">
                        <i class="bi bi-trash"></i>
                    </button>
                    <button class="btn btn-success ms-2" title="Habilitar" @click="restore(item.id, index)" v-else>
                        <i class="bi bi-check-circle"></i>
                    </button>
                </template>
            </SimplePaginatedTable>
        </div>
    </div>
    <Modal
        id="modalCatalogo"
        :title="modalForm.title"
        size="lg"
        v-model="modalForm.isVisible"
    >
        <DynamicForm :schema="form.formSchema" :initialValues="form.initialValues" :is-reset-form="true" :errors="form.errors" @submit="submit" />
    </Modal>
</template>

<script>
import { onMounted, reactive, ref } from 'vue';
import { useToast } from 'vue-toastification';
import SimplePaginatedTable from '@/components/SimplePaginatedTable.vue';
import Modal from '@/components/Modal.vue';
import DynamicForm from '@/components/DynamicForm.vue';

export default {
    name: 'CatalogoComponent',
    components: {
        SimplePaginatedTable,
        Modal,
        DynamicForm,
    },
    props: {
        apiUrl: { type: String, required: true},
        title: { type: String, required: true},
        permission: { type: String, required: true},
        columns: { type: Array, default: [
            {key: 'id', label: 'Id'},
            {key: 'name', label: 'Nombre'},
        ]},
    },
    setup(props) {
        const toast = useToast();
        const apiUrl = props.apiUrl;
        const modalForm = ref({ title: 'Agregar ' + props.title, isVisible: false});
        const state = reactive({
            laravelResponse: { meta: { per_page: 5}, data: [], links: { prev: null, next: null }},
        });
        const form = ref({
            title: 'Nuevo ' + props.title,
            isResetForm: false,
            initialValues: {},
            formSchema: {
                title: null,
                submitText: 'Registrar ' + props.title,
                fields: props.columns.filter(c => c.key != 'id').map(c => {
                    return { name: c.key, ...c}
                })
            }
        });

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.meta.per_page}`;
            axios.get(apiUrlIndex)
            .then(response => {
                state.laravelResponse = response.data
            });
        }

        const create = () => {
            modalForm.value.title = "Crear " + props.title;
            modalForm.value.isVisible = true;
            form.value.formSchema.submitText = 'Registrar ' + props.title;
        };

        const edit = (item, index) => {
            modalForm.value.title = `Modificar ${props.title}: ${item.name || item.nombre}`;
            modalForm.value.isVisible = true;
            form.value.formSchema.submitText = 'Actualizar ' + props.title;
            form.value.initialValues = state.laravelResponse.data[index];
            form.value.initialValues.index = index;
        };

        const submit = (values) => {
            form.value.initialValues.id == undefined ? store(values) : update(values);
        };

        const store = (values) => {
            axios.post(`${apiUrl}`, values)
            .then(response => {
                state.laravelResponse.data.unshift(response.data)
                modalForm.value.isVisible = false;
                toast.success('Se creó: ' + response.data.name);
            });
        };

        const update = (values) => {
            axios.put(`${apiUrl}/${values.id}`, values)
            .then(response => {
                state.laravelResponse.data[values.index] = response.data;
                modalForm.value.isVisible = false;
                toast.success(`${response.data.name} actualizado`);
            });
        };

        const destroy = (item, index) => {
            const confirmDelete = confirm('¿Confirma eliminar: ' + item.name + '?');

            if(!confirmDelete) return;

            axios.delete(`${apiUrl}/${item.id}`)
            .then(() => {
                state.laravelResponse.data[index].deleted_at = new Intl.DateTimeFormat('es-ES').format(new Date());
                toast.info(`${item.name} eliminado`);
            });

        };

        const restore = (id, index) => {
            axios.put(`${apiUrl}/${id}/restore`, {
                deleted_at: null
            })
            .then((response) => {
                state.laravelResponse.data[index].deleted_at = null;
                toast.success(`${response.data.full_correlativo} restaurado correctamente`);
            });

        };

        onMounted(() => {
            index();
            form.value.formSchema = {
                title: null,
                submitText: 'Registrar ' + props.title,
                fields: props.columns.filter(c => c.key != 'id').map(c => {
                    return { name: c.key, ...c}
                })
            };
        });
        return {
            modalForm,
            state,
            form,
            index,
            create,
            edit,
            submit,
            destroy,
            restore,
        }
    }
}
</script>
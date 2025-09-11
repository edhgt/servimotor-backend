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
        :title="modal.title"
        size="lg"
        v-model="modal.isVisible"
    >
        <form autocomplete="off" v-on:submit.prevent="submit">
            <div class="mb-3" v-for="field in fields" :key="field.key">
                <label class="form-label" :for="field.key">{{field.label}}</label>
                <Field class="form-control" :id="field.key" :name="field.key" type="text" :label="field.label.toLowerCase()" rules="required"/>
                <ErrorMessage :name="field.key"></ErrorMessage>
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </Modal>
</template>

<script>
import { onMounted, reactive, ref } from 'vue';
import { useToast } from 'vue-toastification';
import { Field, ErrorMessage, useForm } from 'vee-validate';
import SimplePaginatedTable from '@/components/SimplePaginatedTable.vue';
import Modal from '@/components/Modal.vue';

export default {
    name: 'CatalogoComponent',
    components: {
        Field, ErrorMessage,
        SimplePaginatedTable,
        Modal,
    },
    props: {
        apiUrl: { type: String, required: true},
        title: { type: String, required: true},
        permission: { type: String, required: true},
        columns: { type: Array, default: [
            {key: 'id', label: 'ID'},
            {key: 'name', label: 'Nombre', thStyle: 'width:80%'},
        ]},
    },
    setup(props) {
        const toast = useToast();
        const apiUrl = props.apiUrl;
        const modal = ref({ title: 'Agregar ' + props.title, isVisible: false});
        const state = reactive({
            laravelResponse: { meta: { per_page: 5}, data: [], links: { prev: null, next: null }},
        });
        const { values: correlativoForm, handleSubmit, setFieldValue, setValues, setFieldError, resetForm} = useForm();
        const fields = props.columns.filter(c => c.key !== 'id');

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.meta.per_page}`;
            axios.get(apiUrlIndex)
            .then(response => {
                state.laravelResponse = response.data
            });
        }

        const create = () => {
            modal.value.title = "Crear " + props.title;
            modal.value.isVisible = true;
            resetForm();
            setFieldValue('id', undefined);
        };

        const edit = (item, index) => {
            setValues(item);
            setFieldValue('index', index);
            modal.value.title = `Modificar ${props.title}: ${item.name}`;
            modal.value.isVisible = true;
        };

        const submit = handleSubmit(() => {
            correlativoForm.id === undefined ? store() : update();
        });

        const setErrors = (errors) => {
            if (errors) {
                Object.entries(errors).forEach(([key, value]) => {
                    setFieldError(key, value);
                });
            }
        };

        const store = () => {
            axios.post(`${apiUrl}`, correlativoForm)
            .then(response => {
                state.laravelResponse.data.unshift(response.data)
                resetForm();
                toast.success('Se creó: ' + response.data.name);
            })
            .catch(error => {
                setErrors(error.response.data.errors);
			});
        };

        const update = () => {
            axios.put(`${apiUrl}/${correlativoForm.id}`, correlativoForm)
            .then(response => {
                state.laravelResponse.data[correlativoForm.index] = response.data;
                localStorage.setItem('td', JSON.stringify(state.laravelResponse.data))
                resetForm();
                toast.success(`${response.data.name} actualizado`);
            })
            .catch(error => {
				setErrors(error.response.data.errors);
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
        });
        return {
            modal,
            state,
            index,
            fields,
            create,
            edit,
            submit,
            destroy,
            restore,
        }
    }
}
</script>
<template>
    <div class="row mb-3">
        <div class="col-12">
            <button class="btn btn-primary float-md-end" @click="create">
                <i class="bi bi-plus-lg"></i>
                Crear rol
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
                <template #name="{value, item}">
                    {{ value }}
                    <template v-if="item.deleted_at">
                        <br>
                        <span class="badge text-bg-danger" >Deshabilitado</span>
                    </template>
                </template>
                <template #permissions="{value}">
                    <span class="badge text-bg-secondary ms-1" v-for="permission in value" :key="permission.id">{{permission.name}}</span>
                </template>
                <template #actions="{item, index}">
                    <button class="btn btn-secondary" title="Modificar" @click="edit(item, index)">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger ms-2" title="Eliminar" @click="destroy(item, index)" v-if="item.deleted_at == null">
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
            <div class="mb-3">
                <label class="form-label" for="name">Nombre</label>
                <Field class="form-control" id="name" name="name" type="text" label="nombre" rules="required"/>
                <ErrorMessage name="name"></ErrorMessage>
            </div>
            <div class="mb-3">
                <label class="form-label" for="guard_name">Guard name</label>
                <Field class="form-control" id="guard_name" name="guard_name" type="text" label="guard name" rules="required"/>
                <ErrorMessage name="guard_name"></ErrorMessage>
            </div>
            <div class="mb-3">
                <label class="form-label" for="permissions">Permisos</label>
                <Field v-slot="{ field }" id="permissions" name="permissions" label="permisos" rules="required">
                    <Select v-bind="field" v-model="field.value" url="/api/permissions" :multiple="true"></Select>
                </Field>
                <ErrorMessage name="permissions"></ErrorMessage>
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
import Select from '@/components/Select.vue';

export default {
    name: 'Destinatarios',
    components: {
        Field, ErrorMessage,
        SimplePaginatedTable,
        Modal,
        Select,
    },
    setup() {
        const toast = useToast();
        const apiUrl = '/api/roles';
        const modal = ref({ title: 'Agregar rol', isVisible: false});
        const state = reactive({
            laravelResponse: { per_page: 5, data: []},
            permissions: [],
        });
        const columns = [
            { key: 'id', label: 'ID'},
            { key: 'name', label: 'Nombre'},
            { key: 'guard_name', label: 'Guard name'},
            { key: 'permissions', label: 'Permisos', thStyle: 'width:30%'},
        ];
        const { values: correlativoForm, handleSubmit, setFieldValue, setValues, setFieldError, resetForm} = useForm();

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.per_page}`;
            axios.get(apiUrlIndex)
            .then(response => {
                state.laravelResponse = response.data;
            });
        }

        const create = () => {
            modal.value.title = "Crear rol";
            modal.value.isVisible = true;
            resetForm();
            setFieldValue('id', undefined);
        };

        const edit = (item, index) => {
            setFieldValue('id', item.id);
            setFieldValue('name', item.name);
            setFieldValue('guard_name', item.guard_name);
            const permissions = item.permissions.map(p => p.id);
            setFieldValue('permissions', permissions.length > 0 ? permissions : undefined);
            setFieldValue('index', index);
            modal.value.title = `Modificar: ${item.name}`;
            modal.value.isVisible = true;
        };

        const submit = () => {
            correlativoForm.id === undefined ? store() : update();
        };

        const setErrors = (errors) => {
            if (errors) {
                Object.entries(errors).forEach(([key, value]) => {
                    setFieldError(key, value);
                });
            }
        };

        const store = handleSubmit(() => {
            axios.post(`${apiUrl}`, correlativoForm)
            .then(response => {
                state.laravelResponse.data.unshift(response.data)
                resetForm();
                modal.value.isVisible = false;
                toast.success('Se rol creado exitosamente');
            })
            .catch(error => {
                setErrors(error.response.data.errors);
			});
        });

        const update = () => {
            axios.put(`${apiUrl}/${correlativoForm.id}`, correlativoForm)
            .then(response => {
                modal.value.isVisible = false;
                state.laravelResponse.data[correlativoForm.index] = response.data;
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
            columns,
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
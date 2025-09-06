<template>
    <div class="row mb-3">
        <div class="col-12">
            <button class="btn btn-primary float-md-end" @click="create">
                <i class="bi bi-plus-lg"></i>
                Crear destinatario
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
                        <span class="badge text-bg-danger" >Deshabilitado</span></template>
                    </template>
                <template #actions="{item, index}">
                    <button class="btn btn-secondary" title="Modificar" @click="edit(item, index)" v-can="'destinatarios.edit'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger ms-2" title="Eliminar" @click="destroy(item, index)" v-if="item.deleted_at == null" v-can="'destinatarios.destroy'">
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
                <label class="form-label" for="saludo_id">Saludo</label>
                <Field v-slot="{ field }" id="saludo_id" name="saludo_id" label="saludo" rules="required">
                    <Select v-bind="field" v-model="field.value" url="/api/saludos"></Select>
                </Field>
                <ErrorMessage name="saludo_id"></ErrorMessage>
            </div>
            <div class="mb-3">
                <label class="form-label" for="dependencia_id">Dependencia</label>
                <Field v-slot="{ field }" id="dependencia_id" name="dependencia_id" label="dependencia" rules="required">
                    <Select v-bind="field" v-model="field.value" url="/api/dependencias"></Select>
                </Field>
                <ErrorMessage name="dependencia_id"></ErrorMessage>
            </div>
            <div class="mb-3">
                <label class="form-label" for="entidad_id">Entidad</label>
                <Field v-slot="{ field }" id="entidad_id" name="entidad_id" label="entidad" rules="required">
                    <Select v-bind="field" v-model="field.value" url="/api/entidades"></Select>
                </Field>
                <ErrorMessage name="entidad_id"></ErrorMessage>
            </div>
            <div class="mb-3">
                <label class="form-label" for="cargo_id">Cargo</label>
                <Field v-slot="{ field }" id="cargo_id" name="cargo_id" label="cargo" rules="required">
                    <Select v-bind="field" v-model="field.value" url="/api/cargos"></Select>
                </Field>
                <ErrorMessage name="cargo_id"></ErrorMessage>
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
    setup(props) {
        const toast = useToast();
        const apiUrl = '/api/destinatarios';
        const modal = ref({ title: 'Agregar destinatario', isVisible: false});
        const state = reactive({
            laravelResponse: { per_page: 5, data: []},
        });
        const columns = [
            { key: 'id', label: 'ID'},
            { key: 'name', label: 'Nombre'},
            { key: 'saludo', label: 'Saludo'},
            { key: 'dependencia', label: 'Dependencia'},
            { key: 'entidad', label: 'Entidad'},
            { key: 'cargo', label: 'Cargo'},
        ];
        const { values: correlativoForm, handleSubmit, setFieldValue, setValues, setFieldError, resetForm} = useForm();

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.per_page}`;
            axios.get(apiUrlIndex)
            .then(response => {
                state.laravelResponse = response.data
            });
        }

        const create = () => {
            modal.value.title = "Crear destinatario";
            modal.value.isVisible = true;
            resetForm();
            setFieldValue('id', undefined);
        };

        const edit = (item, index) => {
            setValues(item);
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
                toast.success('Se destinatario creado exitosamente');
            })
            .catch(error => {
                setErrors(error.response.data.errors);
			});
        });

        const update = () => {
            axios.put(`${apiUrl}/${correlativoForm.id}`, correlativoForm)
            .then(response => {
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
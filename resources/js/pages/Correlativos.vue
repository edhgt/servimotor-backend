<template>
    <div class="row mb-3" v-can="'correlativos.create'">
        <div class="col-12">
            <button class="btn btn-primary float-md-end" @click="create">
                <i class="bi bi-plus-lg"></i>
                Nuevo correlativo
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <SimplePaginatedTable
                :laravel-response="state.laravelResponse"
                :columns="state.columns"
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
                    <button class="btn btn-secondary" title="Modificar" @click="edit(item, index)" v-can="'correlativos.edit'">
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
        id="modalCorrelativo"
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
            <div class="row mb-3">
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="correlativo">Correlativo</label>
                    <Field class="form-control" id="correlativo" name="correlativo" type="number" step="1" label="correlativo" rules="required"/>
                    <ErrorMessage name="correlativo"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="anio">Año</label>
                    <Field class="form-control" id="anio" name="anio" type="number" step="1" label="año" rules="required"/>
                    <ErrorMessage name="anio"></ErrorMessage>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="prefix">Prefijo</label>
                    <Field class="form-control" id="prefix" name="prefix" type="text" label="prefijo" rules="required"/>
                    <ErrorMessage name="prefix"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="directory">Carpeta almacenamiento</label>
                    <Field class="form-control" id="directory" name="directory" type="text" label="carpeta" rules="required"/>
                    <ErrorMessage name="directory"></ErrorMessage>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" for="plantilla_id">
                    Plantilla
                </label>
                <Field id="plantilla_id" name="plantilla_id" label="tipo de documento" v-slot="{field}">
                    <Select v-bind="field" v-model="field.value" url="/api/plantillas"></Select>
                </Field>
                <ErrorMessage name="plantilla_id"></ErrorMessage>
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
    name: 'Correlativos',
    components: {
        Field, ErrorMessage,
        SimplePaginatedTable,
        Modal,
        Select,
    },
    setup() {
        const toast = useToast();
        const apiUrl = '/api/tipo-documentos';
        const modal = ref({ title: 'Agregar correlativo', isVisible: false});
        const state = reactive({
            laravelResponse: { per_page: 5, data: []},
            columns: [
                {key: 'id', label: 'ID'},
                {key: 'name', label: 'Nombre'},
                {key: 'prefix', label: 'Prefijo'},
                {key: 'correlativo', label: 'Correlativo'},
                {key: 'anio', label: 'Año'},
                {key: 'full_correlativo', label: 'Correlativo completo'},
            ]
        });
        const { values: correlativoForm, handleSubmit, setFieldValue, setValues, setFieldError, resetForm} = useForm();

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.per_page}`;
            axios.get(apiUrlIndex)
            .then(response => {
                localStorage.setItem('td', JSON.stringify(response.data.data))
                state.laravelResponse = response.data
            });
        }

        const create = () => {
            modal.value.title = "Crear correlativo";
            modal.value.isVisible = true;
            resetForm();
            setFieldValue('id', undefined);
        };

        const edit = (item, index) => {
            setValues(item);
            setFieldValue('index', index);
            modal.value.title = "Actualizar correlativo: " + item.full_correlativo;
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
                state.laravelResponse.data.push(response.data)
                localStorage.setItem('td', JSON.stringify(state.laravelResponse.data))
                modal.value.isVisible = false;
                resetForm();
                toast.success('Se creo un correlativo');
            })
            .catch(error => {
                setErrors(error.response.data.errors);
			});
        });

        const update = () => {
            axios.put(`${apiUrl}/${correlativoForm.id}`, correlativoForm)
            .then(response => {
                state.laravelResponse.data[correlativoForm.index] = response.data;
                localStorage.setItem('td', JSON.stringify(state.laravelResponse.data))
                modal.value.isVisible = false;
                resetForm();
                toast.success(`Correlativo ${response.data.full_correlativo} actualizado`);
            })
            .catch(error => {
				setErrors(error.response.data.errors);
			});
        };

        const destroy = (correlativo, index) => {
            const confirmDelete = confirm('Desea eliminar el correlativo: ' + correlativo.full_correlativo);

            if(!confirmDelete) return;

            axios.delete(`${apiUrl}/${correlativo.id}`)
            .then(() => {
                state.laravelResponse.data[index].deleted_at = new Intl.DateTimeFormat('es-ES').format(new Date());
                toast.info(`Correlativo ${correlativo.full_correlativo} eliminado`);
            });

        };

        const restore = (id, index) => {
            axios.put(`${apiUrl}/${id}/restore`, {
                deleted_at: null
            })
            .then((response) => {
                state.laravelResponse.data[index].deleted_at = null;
                toast.success(`Correlativo ${response.data.full_correlativo} restaurado correctamente`);
            });

        };

        onMounted(() => {
            index();
        });
        return {
            modal,
            state,
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
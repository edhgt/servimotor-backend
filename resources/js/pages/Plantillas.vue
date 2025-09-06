<template>
    <div class="row mb-3" v-can="'plantillas.create'">
        <div class="col-12">
            <button class="btn btn-primary float-md-end" @click="create">
                <i class="bi bi-plus-lg"></i>
                Nuevo plantilla
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
                        <span class="badge text-bg-danger" >Deshabilitado</span>
                    </template>
                </template>
                <template #tipo_documentos="{value}">
                    <span class="me-1 badge text-bg-secondary" v-for="tipoDocumento in value">{{tipoDocumento.name}}</span>
                </template>
                <template #actions="{item, index}">
                    <button class="btn btn-secondary" title="Modificar" @click="edit(item, index)" v-can="'plantillas.edit'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger ms-2" title="Eliminar" @click="destroy(item, index)" v-if="item.deleted_at == null" v-can="'plantillas.destroy'">
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
        id="modalPlantilla"
        :title="modal.title"
        size="xl"
        v-model="modal.isVisible"
    >
        <form autocomplete="off" v-on:submit.prevent="submit">
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-lg-6">
                    <label class="form-label" for="tipo_documentos">
                        Tipo de documento
                    </label>
                    <Field id="tipo_documentos" name="tipo_documentos" label="tipo de documento" rules="required" v-slot="{field}">
                        <Select v-bind="field" v-model="field.value" url="/api/tipo-documentos" :multiple="true"></Select>
                    </Field>
                    <ErrorMessage name="tipo_documentos"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="form-label" for="name">Nombre</label>
                    <Field class="form-control" id="name" name="name" type="text" label="name" rules="required"/>
                    <ErrorMessage name="name"></ErrorMessage>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-lg-6">
                    <label class="form-label" for="orientation">
                        Orientación
                    </label>
                    <Field id="orientation" name="config.orientation" label="orientación" rules="required" v-slot="{field}">
                        <v-select v-bind="field" v-model="field.value" :options="config.orientation" :reduce="option => option.code"></v-select>
                    </Field>
                    <ErrorMessage name="config.orientation"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="form-label" for="format">Tamaño de página</label>
                    <Field id="format" name="config.format" label="tamaño de página" rules="required" v-slot="{field}">
                        <v-select v-bind="field" v-model="field.value" :options="config.format" :reduce="option => option.code"></v-select>
                    </Field>
                    <ErrorMessage name="config.format"></ErrorMessage>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-lg-6" v-for="margin in config.config" :key="margin.code">
                    <label class="form-label" :for="margin.code">
                        {{ margin.label }}
                    </label>
                    <Field class="form-control" :id="margin.code" :name="'config.' + margin.code" :label="margin.label.toLowerCase()" type="text"/>
                    <ErrorMessage :name="'config.' + margin.code"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <label class="form-label" for="config.default_font">
                        Tipo de letra
                    </label>
                    <Field id="config.default_font" name="config.default_font" label="tipo de letra" v-slot="{field}">
                        <v-select v-bind="field" v-model="field.value" :options="config.default_font" :reduce="option => option.code"></v-select>
                    </Field>
                    <ErrorMessage name="config.default_font"></ErrorMessage>
                </div>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-12 col-lg-6">
                    <div class="form-check">
                        <Field v-slot="{ field }" name="is_header" type="checkbox" label="tiene encabezado" :value="true" :unchecked-value="false">
                            <input type="checkbox" id="is_header" class="form-check-input" name="is_header" v-bind="field" :value="true" />
                            <label class="form-check-label" for="is_header">
                                Tiene encabezado <br>
                                <ErrorMessage name="is_header"></ErrorMessage>
                            </label>
                        </Field>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="form-check">
                        <Field v-slot="{ field }" name="is_footer" type="checkbox" label="tiene pie de página" :value="true" :unchecked-value="false">
                            <input type="checkbox" id="is_footer" class="form-check-input" name="is_footer" v-bind="field" :value="true" />
                            <label class="form-check-label" for="is_footer">
                                Tiene pie de página <br>
                                <ErrorMessage name="is_footer"></ErrorMessage>
                            </label>
                        </Field>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <div class="form-check">
                    <Field v-slot="{ field }" name="is_paginado" type="checkbox" label="mostrar número de página" :value="true" :unchecked-value="false">
                        <input type="checkbox" id="is_paginado" class="form-check-input" name="is_paginado" v-bind="field" :value="true" />
                        <label class="form-check-label" for="is_paginado">
                            Mostrar número de página <br>
                            <ErrorMessage name="is_paginado"></ErrorMessage>
                        </label>
                    </Field>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label" for="content">Contenido HTML</label>
                <Field id="content" name="content" label="contenido" rules="required" v-slot="{field}">
                    <Editor 
                        :modelValue="field.value"
                        @update:modelValue="field.onChange"
                        @blur="field.onBlur"
                    ></Editor>
                </Field>
                <ErrorMessage name="content"></ErrorMessage>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </Modal>
</template>

<script>
import { onMounted, reactive, ref } from 'vue';
import { useToast } from 'vue-toastification';
import { Field, ErrorMessage, useForm } from 'vee-validate';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import SimplePaginatedTable from '@/components/SimplePaginatedTable.vue';
import Modal from '@/components/Modal.vue';
import Editor from '@/components/Editor.vue';
import Select from '@/components/Select.vue';

export default {
    name: 'Plantillas',
    components: {
        Field, ErrorMessage,
        'v-select': vSelect,
        SimplePaginatedTable,
        Modal,
        Editor,
        Select,
    },
    setup() {
        const toast = useToast();
        const apiUrl = '/api/plantillas';
        const modal = ref({ title: 'Agregar plantilla', isVisible: false});
        const state = reactive({
            laravelResponse: { per_page: 5, data: []},
            columns: [
                {key: 'id', label: 'ID'},
                {key: 'name', label: 'Nombre', thStyle: 'width: 40%'},
                {key: 'tipo_documentos', label: 'Tipo de documentos asociados', thStyle: 'width: 35%'},
            ]
        });
        const { values: plantillaForm, handleSubmit, setFieldValue, setValues, setFieldError, resetForm} = useForm();
        const config = {
            orientation: [
                { code: 'P', label: 'Vertical (P)' },
                { code: 'L', label: 'Horizontal (L)' },
            ],
            format: [
                { code: 'A4', label: 'A4' },
                { code: 'Letter', label: 'Carta' },
                { code: 'Legal', label: 'Legal' },
            ],
            config: [
                { code: 'margin_top', label: 'Margen superior' },
                { code: 'margin_bottom', label: 'Margen inferior' },
                { code: 'margin_left', label: 'Margen izquierdo' },
                { code: 'margin_right', label: 'Margen derecho' },
                { code: 'margin_header', label: 'Margen encabezado' },
                { code: 'margin_footer', label: 'Margen pie de página' },
                { code: 'line_height', label: 'Altura de línea' },
                { code: 'default_font_size', label: 'Tamaño de fuente' },
            ],
            default_font: [
                { code: "arial", label: "Arial" },
                { code: "altivo-extralight", label: "Altivo Extra Light" },
                { code: "altivo-regular", label: "Altivo Regular" },
                { code: "altivo-thin", label: "Altivo Thin" },
                { code: "courier", label: "Courier" },
                { code: "dejavusans", label: "DejaVu Sans" },
                { code: "dejavusanscondensed", label: "DejaVu Sans Condensed" },
                { code: "dejavusansmono", label: "DejaVu Sans Mono" },
                { code: "dejavuserif", label: "DejaVu Serif" },
                { code: "freesans", label: "Free Sans" },
                { code: "freeserif", label: "Free Serif" },
                { code: "helvetica", label: "Helvetica" },
                { code: "symbol", label: "Symbol" },
                { code: "times", label: "Times New Roman" },
                { code: "zapfdingbats", label: "Zapf Dingbats" }
            ]
        };

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.per_page}`;
            axios.get(apiUrlIndex)
            .then(response => {
                localStorage.setItem('td', JSON.stringify(response.data.data))
                state.laravelResponse = response.data
            });
        }

        const create = () => {
            modal.value.title = "Crear plantilla";
            modal.value.isVisible = true;
            resetForm();
            setFieldValue('id', undefined);
        };

        const edit = (item, index) => {
            setValues(item);
            setFieldValue('index', index);
            setFieldValue('tipo_documentos', item.tipo_documentos.map(td => td.id));
            modal.value.title = "Actualizar plantilla: " + item.name;
            modal.value.isVisible = true;
        };

        const submit = handleSubmit(() => {
            plantillaForm.id === undefined ? store() : update();
        });

        const setErrors = (errors) => {
            if (errors) {
                Object.entries(errors).forEach(([key, value]) => {
                    setFieldError(key, value);
                });
            }
        };

        const store = () => {
            axios.post(`${apiUrl}`, plantillaForm)
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
        };

        const update = () => {
            axios.put(`${apiUrl}/${plantillaForm.id}`, plantillaForm)
            .then(response => {
                state.laravelResponse.data[plantillaForm.index] = response.data;
                modal.value.isVisible = false;
                toast.success(`Plantilla ${response.data.name} actualizada`);
            })
            .catch(error => {
				setErrors(error.response.data.errors);
			});
        };

        const destroy = (correlativo, index) => {
            const confirmDelete = confirm('Desea eliminar la plantilla: ' + correlativo.full_correlativo);

            if(!confirmDelete) return;

            axios.delete(`${apiUrl}/${correlativo.id}`)
            .then(() => {
                state.laravelResponse.data[index].deleted_at = new Intl.DateTimeFormat('es-ES').format(new Date());
                toast.info(`Plantilla ${correlativo.full_correlativo} eliminada`);
            });

        };

        const restore = (id, index) => {
            axios.put(`${apiUrl}/${id}/restore`, {
                deleted_at: null
            })
            .then((response) => {
                state.laravelResponse.data[index].deleted_at = null;
                toast.success(`Plantilla ${response.data.full_correlativo} restaurada correctamente`);
            });

        };

        onMounted(() => {
            index();
        });
        return {
            modal,
            state,
            config,
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
<template>
    <div class="row">
        <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-body px-4">
                    <form id="formDocumento" autocomplete="off" v-on:submit.prevent="submit">
                        <a class="text-muted" href="#" title="Regresar" v-on:click="$router.go(-1)">
                            <i class="fas fa-arrow-left fa-lg"></i>
                        </a>
                        <h3 class="mb-3" v-if=documentForm.correlativo>Correlativo: {{ documentForm.correlativo }}</h3>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="fecha_emision">Fecha de emisión</label>
                                <input class="form-control" type="text" :value="documentForm.fecha_emision" disabled>
                            </div>
                            <div class="col-sm-12 col-lg-6">
                                <label class="form-label" for="tipo_documento_id">
                                    Reserva de
                                </label>
                                <Field id="tipo_documento_id" name="tipo_documento_id" label="tipo de documento" rules="required" v-slot="{field}">
                                    <Select v-bind="field" v-model="field.value" url="/api/tipo-documentos"></Select>
                                </Field>
                                <ErrorMessage name="tipo_documento_id"></ErrorMessage>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="destinatario_id">Destinatario</label>
                            <Field id="destinatario_id" name="destinatario_id" label="destinatario" rules="required" v-slot="{field}">
                                <Select v-bind="field" v-model="field.value" url="/api/destinatarios">
                                    <template #selected-option="{ saludo, name, dependencia, entidad, cargo }" v-if="field.value">
                                        <div>
                                            {{ saludo?.name }}:
                                            <strong> {{ name }}</strong>,
                                            {{ cargo?.name }},
                                            {{ dependencia?.name }},
                                            {{ entidad?.name }}
                                        </div>
                                    </template>
                                </Select>
                            </Field>
                            <ErrorMessage name="destinatario_id"></ErrorMessage>
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label" for="asunto">Asunto</label>
                            <Field class="form-control" id="asunto" name="asunto"  type="text" rules="required"/>
                            <ErrorMessage name="asunto"></ErrorMessage>
                        </div>
        
                        <div class="mb-3">
                            <label class="form-label" for="respuesta">Respuesta</label>
                            <Field id="respuesta" name="respuesta" label="respuesta" rules="required" v-slot="{field}">
                                <Editor 
                                    :modelValue="field.value"
                                    @update:modelValue="field.onChange"
                                    @blur="field.onBlur"
                                ></Editor>
                            </Field>
                            <ErrorMessage name="respuesta"></ErrorMessage>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="referencia">
                                Referencia
                                <small>(opcional)</small>
                            </label>
                            <Field class="form-control" id="referencia" name="referencia" :rules="{required: false}" type="text"/>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="file_referencia">
                                Adjuntar referencia
                                <small>(opcional)</small>
                            </label>
                            <Field name="file_referencia" label="archivo de referencia" rules="mimes:application/pdf|size:10000" v-slot="{ handleChange, handleBlur, field }">
                                <input id="file_referencia" class="form-control" type="file" @change="handleChange" @blur="handleBlur"/>
                            </Field>
                            <br>
                            <ErrorMessage name="pdf"></ErrorMessage>
                        </div>
                        <button id="saveButton" type="submit" class="btn btn-primary">
                            <i class="fas fa-save fa-lg mr-2"></i>
                            Guardar
                        </button>
                    </form>
                </div>
                <div class="card-footer text-center" v-if="documento?.id">
                    <documento-actions-component :documento="documento" type="buttons"/>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineAsyncComponent, onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import { defineRule, useForm, Field, ErrorMessage } from 'vee-validate';
import { mimes, size } from '@vee-validate/rules';
import { setErrorsToFields } from '@/utils/form';
import Swal from 'sweetalert2';
import copy from 'copy-to-clipboard';
import Editor from '@/components/Editor.vue';
import Select from '@/components/Select.vue';
import { useToast } from 'vue-toastification';

defineRule('mimes', mimes);
defineRule('size', size);

export default {
    name: 'CrearDocumento',
    components: {
        Select,
        Editor,
        Field, ErrorMessage,
        DocumentoActionsComponent: defineAsyncComponent(() => import('@/components/DocumentoActionsComponent.vue'))
    },
    setup() {
        const router = useRouter();
        const route = useRoute();
        const toast = useToast();
        const {values: documentForm, handleSubmit, setValues, setFieldValue, setFieldError, resetForm} = useForm();
        const documento = ref();

        const submit = () => {
            documentForm.id ? update() : store();
        };

        const store = handleSubmit(() => {
            axios.post(`/api/documentos`, documentForm, {
                headers: { 'Content-Type': 'multipart/form-data'}
            })
            .then((response) => {
                const button = document.getElementById('saveButton');
                button.blur();
                Swal.fire({
                    icon: 'success',
                    customClass: {
                        validationMessage: 'my-validation-message',
                    },
                    title: 'Documento reservado exitosamente',
                    html: `
                        <table class="table">
                            <thead><tr><td class=></td><td></td></tr></thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span class="float-end">Tipo:</span>
                                    </td>
                                    <td>
                                        <span class="float-start">${ response.data.tipo_documento.name }</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="float-end">Correlativo:</span>
                                    </td>
                                    <td>
                                        <span class="float-start">
                                            ${ response.data.correlativo }
                                            <i id="btn-copy-correlativo" role="button" class="ms-2 bi bi-copy" title="Copiar correlativo"></i>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    `,
                    didOpen: () => {
                        const btnCopy = document.getElementById('btn-copy-correlativo');
                        if (btnCopy) {
                            btnCopy.addEventListener('click', () => {
                                copy(response.data.correlativo);
                                Swal.showValidationMessage('<i class="bi bi-clipboard-check"></i> Correlativo copiado al portapapeles');
                            });
                        }
                    }
                }).then(() => {
                    router.push({ name: 'ShowDocument', params: { id: response.data.id}});
                    /*
                    const fecha = documentForm.fecha_emision;
                    const tipo_documento_id = documentForm.tipo_documento_id;
                    resetForm();
                    setFieldValue('fecha_emision', fecha);
                    setFieldValue('tipo_documento_id', tipo_documento_id);
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    */
                });
            }).catch(error => {
                setErrorsToFields(error.response.data.errors, setFieldError);
            });
        });

        const update = handleSubmit(() => {
            axios.post(`/api/documentos/${documentForm.id}`, {
                ...documentForm,
                _method: 'PUT'
            }, {
                headers: { 'Content-Type': 'multipart/form-data'}
            }).then(response => {
                documento.value = response.data;
                toast.info(`Documento ${response.data.correlativo} actualizado`);
            });
        });

        onMounted(() => {
            const id = route.params.id;
            
            if(id) {
                axios.get(`/api/documentos/${id}`)
                .then(async (response) => {
                    const documentoDB = response.data;

                    documento.value = response.data;

                    if(documento.value.estado_documento_id == 3) {
                        router.back();
                    }
                    setValues({
                        id: documentoDB.id,
                        asunto: documentoDB.asunto,
                        correlativo: documentoDB.correlativo,
                        destinatario_id: documentoDB.destinatario_id,
                        respuesta: documentoDB.respuesta,
                        tipo_documento_id: documentoDB.tipo_documento_id,
                        referencia: documentoDB.referencia,
                        fecha_emision: documentoDB.fecha_emision
                    });
                });
            } else {
                setFieldValue('id', undefined);
                setFieldValue('tipo_documento_id', Number(route.query.type));
                setFieldValue('fecha_emision', new Date().toISOString().substring(0,10));
            }
        });
        return {
            documentForm,
            documento,
            submit
        }
    },
}
</script>

<style>
@import '@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css';

.my-validation-message::before {
  display: none;
}

.my-validation-message i {
  margin: 0 0.4em;
  color: var(--bs-green);
  font-size: 1.4em;
}

</style>

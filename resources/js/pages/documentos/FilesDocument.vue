<template>
    <div class="row">
        <div class="col-12">
            <button class="btn btn-primary float-end mb-2" @click="create">
                <i class="bi bi-upload me-2"></i>
                Agregar archivo
            </button>
            <table class="table table-hover table-stripped table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(file, index) in archivos">
                        <td>
                            {{ file.titulo }}
                        </td>
                        <td>{{ file.path }}</td>
                        <td>
                            <a :href="'/storage/' + file.path" target="_blank">
                                <i class="bi bi-download text-secondary fs-5 me-1"></i>
                            </a>
                            <i class="bi bi-pencil-square text-primary fs-5 me-1" role="button" @click="edit(index)"></i>
                            <i class="bi bi-trash text-danger fs-5 me-1" role="button" @click="destroy(file.id, index)"></i>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Modal id="archivoModal" :title="modal.title" :size="modal.size" v-model="modal.isVisible">
            <form @submit.prevent="onSubmit">
                <div class="mb-3">
                    <label class="form-label" for="file">Archivo</label><br>
                    <Field type="file" id="fle" name="file" label="archivo" :rules="{ required: modal.type === 'create', mimes: 'application/pdf', size: 10000}" v-slot="{ field }">
                        <input type="file" v-bind="field" @change="changeFileHandler"/>
                    </Field>
                    <br>
                    <ErrorMessage name="file"></ErrorMessage>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="titulo">Titulo</label>
                    <Field class="form-control" id="titulo" name="titulo" label="título" rules="required" />
                    <ErrorMessage name="titulo" />
                </div>
                <button class="btn btn-primary mb-3" type="submit">
                    <i class="fas fa-upload fa-lg"></i>
                    Subir pdf
                </button>
            </form>
        </Modal>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { defineRule, useForm, Field, ErrorMessage } from 'vee-validate';
import { mimes, size } from '@vee-validate/rules';
import Modal from '@/components/Modal.vue';
import { useToast } from 'vue-toastification';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

export default {
    name: 'ViewDocument',
    components: {
        Field, ErrorMessage,
        Modal,
    },
    setup() {
        const archivos = ref([]);
        const route = useRoute();
        const toast = useToast();
        const API_URL = `/api/documentos/${route.params.id}/archivos`;
        const modal = ref({
            title: 'Nuevo archivo',
            isVisible: false,
            size: 'xl',
            type: 'create'
        });
        const currentIndex = ref();

        const { values: formArchivo, setFieldValue, resetForm, handleSubmit} = useForm();

        const getFiles = () => {
            axios.get(API_URL).then(response => {
                archivos.value = response.data;
            });
        }

        const setModal = (title, type) => {
            modal.value.title = title,
            modal.value.isVisible = true;
            modal.value.type = type;
        };

        const create = () => {
            setModal('Nuevo archivo', 'create');
            resetForm();
        };

        const changeFileHandler = () => {
            setFieldValue('titulo', formArchivo.file.name);
        };

        const store = () => {
            NProgress.start();
            axios.post(API_URL, formArchivo, {
                headers: { 'Content-Type': 'multipart/form-data'}
            }).then(response => {
                NProgress.done();
                modal.value.isVisible = false;
                archivos.value.push(response.data);
                toast.success('Archivo guardado correctamente');
                resetForm();
            }).catch(() => {
                NProgress.done();
            });
        };

        const edit = (index) => {
            currentIndex.value = index;
            setFieldValue('titulo', archivos.value[currentIndex.value].titulo);
            setModal('Modificar archivo', 'update');
        };
        const update = () => {
            const id = archivos.value[currentIndex.value].id;
            axios.post(`${API_URL}/${id}`, {
                ...formArchivo,
                '_method': 'PUT'
            }, {
                headers: { 'Content-Type': 'multipart/form-data'}
            }).then(response => {
                modal.value.isVisible = false;
                archivos.value[currentIndex.value] = response.data;
                toast.success('Archivo actualizado correctamente');
                resetForm();
            });
        };
        const destroy = (id, index) => {
            const confirmDestroy = confirm(`Eliminar el archivo: ${archivos.value[index].titulo}`);
            if(!confirmDestroy) return;
            axios.delete(`${API_URL}/${id}`).then(() => {
                archivos.value.splice(index, 1);
                toast.info('Archivo eliminado correctamente');
            });
        };

        const onSubmit = handleSubmit(() => {
            modal.value.type == 'create' ? store() : update();
        });

        onMounted(() => {
            defineRule('mimes', mimes);
			defineRule('size', size);
            getFiles();
        });
        return {
            archivos,
            modal,
            create,
            changeFileHandler,
            onSubmit,
            edit,
            destroy,
        };
    }
}
</script>
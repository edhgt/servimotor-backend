<template>
    <div class="row mb-2">
        <div class="col-12">
            <div class="btn-group float-end">
                <button class="btn btn-outline-primary" @click="create" v-can="'users.create'">
                    <i class="bi bi-person-plus"></i>
                    Nuevo cliente
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <SimplePaginatedTable
                :laravel-response="state.laravelResponse"
                :columns="columns"
                :tiene-busqueda-avanzada="true"
                @change-page="index"
            >
                <template #actions="{ item, index }">
                    <button type="button" class="btn btn-primary btn-sm" title="Modificar cliente" @click="edit(item, index)" v-can="'users.edit'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" title="Deshabilitar cliente" @click="destroy(item, index)" v-if="item.deleted_at == null" v-can="'users.delete'">
                        <i class="bi bi-trash"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" title="Habilitar cliente" @click="restore(item.id, index)" v-else>
                        <i class="bi bi-check-square"></i>
                    </button>
                </template>
            </SimplePaginatedTable>
        </div>
    </div>

    <Modal
        id="modalFormLocalUserCreate"
        :title="modalFormLocalUserCreate.title"
        size="lg"
        v-model="modalFormLocalUserCreate.isVisible"
        >
        <DynamicForm :schema="modalFormLocalUserCreate.formSchema" :initialValues="modalFormLocalUserCreate.initialValues" :is-reset-form="modalFormLocalUserCreate.isResetForm" :errors="modalFormLocalUserCreate.errors" @submit="submit" />
    </Modal>

</template>

<script>
import { onMounted, reactive, ref } from "vue";
import { useToast } from "vue-toastification";
import SimplePaginatedTable from "@/components/SimplePaginatedTable.vue";
import Modal from "@/components/Modal.vue";
import DynamicForm from "@/components/DynamicForm.vue";

export default {
    name: 'Users',
    components: {
        SimplePaginatedTable,
        Modal,
        DynamicForm,
    },
    setup() {
        const toast = useToast();
        const apiUrl = '/api/clientes';
        const state = reactive({
            laravelResponse: { meta: { per_page: 5}, data: [], links: { prev: null, next: null }},
            rolesSelected: [],
        });
        const columns = [
            {key: 'id', label: 'Id'},
            {key: 'nit', label: 'Nit'},
            {key: 'nombre_completo', label: 'Nombre completo'},
            {key: 'direccion', label: 'Dirección'},
            {key: 'telefono', label: 'Teléfono'},
            {key: 'created_at', label: 'Fecha creación'},
            {key: 'updated_at', label: 'Fecha actualiación'},
        ];

        const modalFormLocalUserCreate = ref({
            title: 'Nuevo cliente',
            isVisible: false,
            isResetForm: false,
            initialValues: {
                isRandomPassword: true,
                isSendPassword: true,
            },
            formSchema: {
                title: 'Datos generales',
                submitText: 'Registrar cliente',
                fields: [
                    {
                        label: 'Nit',
                        name: 'nit',
                        as: 'input',
                        rules: 'max:255',
                        col: 6,
                    },
                    {
                        label: 'Teléfono',
                        name: 'telefono',
                        type: 'tel',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Primer nombre',
                        name: 'primer_nombre',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Segundo nombre',
                        name: 'segundo_nombre',
                        as: 'input',
                        rules: 'max:255',
                        col: 6,
                    },
                    {
                        label: 'Primer apellido',
                        name: 'primer_apellido',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Segundo apellido',
                        name: 'segundo_apellido',
                        as: 'input',
                        rules: 'max:255',
                        col: 6,
                    },
                    {
                        label: 'Dirección',
                        name: 'direccion',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 12,
                    },
                ]
            },
            errors: {}
        });

        const index = (url = undefined) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.meta.per_page}`;
            axios.get(apiUrlIndex).then(response => state.laravelResponse = response.data);
        };

        const create = () => {
            modalFormLocalUserCreate.value.isVisible = true;
        };

        const submit = (values) => {
            if(values.id) {
                update(values);
            } else {
                store(values);
            }
        };

        const store = (values) => {
            axios.post(apiUrl, values)
            .then(response => {
                toast.success(`Usuario ${response.data.name} <${response.data.email}> creado correctamente`);
                state.laravelResponse.data.unshift(response.data);
                modalFormLocalUserCreate.value.isVisible = false;
                modalFormLocalUserCreate.value.isResetForm = true;
            }).catch(errors => {
                modalFormLocalUserCreate.value.errors = errors.response.data.errors;
            });
        };

        const getRolesByUserId = (id) => {
            axios.get(`${apiUrl}/${id}`, {params: { roles: true}}).then(response => {
                const roles = response.data.map(r => r.id);
                modalFormLocalUserCreate.value.initialValues.roles = roles;
            });
        }

        const edit = (item, index) => {
            getRolesByUserId(item.id);
            modalFormLocalUserCreate.value.isVisible = true;
            modalFormLocalUserCreate.value.isResetForm = true;
            modalFormLocalUserCreate.value.initialValues = {
                ...modalFormLocalUserCreate.value.initialValues,
                ...item,
                ...item.empleado
            };
            modalFormLocalUserCreate.value.title = 'Modificar cliente: ' + item.nombre_completo;
            modalFormLocalUserCreate.value.formSchema.submitText = 'Actualizar cliente';
            modalFormLocalUserCreate.value.initialValues.index = index;
            modalFormLocalUserCreate.value.initialValues.id = item.id;

        };

        const update = (values) => {
            axios.patch(`${apiUrl}/${values.id}`, values)
            .then(response => {
                state.laravelResponse.data[modalFormLocalUserCreate.value.index] = response.data;
                modalFormLocalUserCreate.value.isVisible = false;
                toast.info(`Usuario ${values.name} <${values.email}> actualizado`);
            })
            .catch(error => {
                modalFormLocalUserCreate.value.errors = errors.response.data.errors;
            });

        };

        const destroy = (item, index) => {
            const userToDelete = `${item.name} <${item.email}>`;
            const confirmDeleteUser = confirm(
                `¿Está seguro de que desea deshabilitar a ${userToDelete}?\n\n` +
                'Podrá restaurarlo más adelante.'
            );
            if(confirmDeleteUser) {
                axios.delete(`${apiUrl}/${item.id}`).then(() => {
                    state.laravelResponse.data[index].deleted_at = new Date().toDateString();
                    
                    toast.info(`Se deshabilitó a: ${userToDelete}`);

                });
            }
        };

        const restore = (id, index) => {
            axios.post(`${apiUrl}/${id}/restore`).then(() => {
                state.laravelResponse.data[index].deleted_at = null;
            });
        };

        onMounted(() => {
            index();
        });
        return {
            state,
            columns,
            modalFormLocalUserCreate,
            index,
            create,
            submit,
            edit,
            destroy,
            restore
        };
    }
}
</script>
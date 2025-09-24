<template>
    <div class="row mb-2">
        <div class="col-12">
            <div class="btn-group float-end">
                <button class="btn btn-outline-primary" @click="create" v-can="'users.create'">
                    <i class="bi bi-person-plus"></i>
                    Nuevo usuario
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
                <template #deleted_at="{ value }">
                    <span class="badge text-bg-success" v-if="value == null">Activo</span>
                    <span class="badge text-bg-danger" v-else>Inactivo</span>
                </template>
                <template #actions="{ item, index }">
                    <button type="button" class="btn btn-primary btn-sm" title="Modificar usuario" @click="edit(item, index)" v-can="'users.edit'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" title="Deshabilitar usuario" @click="destroy(item, index)" v-if="item.deleted_at == null" v-can="'users.destroy'">
                        <i class="bi bi-trash"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" title="Habilitar usuario" @click="restore(item.id, index)" v-else>
                        <i class="bi bi-check-square"></i>
                    </button>
                </template>
            </SimplePaginatedTable>
        </div>
    </div>

    <Modal
        id="modalFormLocalUserCreate"
        :title="modalFormLocalUserCreate.title"
        size="xl"
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
        const apiUrl = '/api/users';
        const state = reactive({
            laravelResponse: { meta: { per_page: 5}, data: [], links: { prev: null, next: null }},
            rolesSelected: [],
        });
        const columns = [
            {key: 'id', label: 'Id'},
            {key: 'name', label: 'Nombre'},
            {key: 'username', label: 'Usuario'},
            {key: 'email', label: 'Correo electrónico'},
            {key: 'created_at', label: 'Fecha creación'},
            {key: 'updated_at', label: 'Fecha actualiación'},
            {key: 'deleted_at', label: 'Estado'},
        ];

        const modalFormLocalUserCreate = ref({
            title: 'Nuevo usuario',
            isVisible: false,
            isResetForm: false,
            initialValues: {
                isRandomPassword: true,
                isSendPassword: true,
            },
            formSchema: {
                title: 'Datos generales',
                submitText: 'Registrar usuario',
                fields: [
                    {
                        label: 'Documento Personal de Identificación',
                        name: 'cui',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Nit',
                        name: 'nit',
                        as: 'input',
                        rules: 'max:255',
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
                        label: 'Fecha de nacimiento',
                        name: 'fecha_nacimiento',
                        type: 'date',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Dirección',
                        name: 'direccion',
                        as: 'input',
                        rules: 'required|max:255',
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
                        label: 'Fecha de contratación',
                        name: 'fecha_contratacion',
                        type: 'date',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Puesto',
                        name: 'puesto_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/puestos'
                    },
                    {
                        label: 'Correo electrónico',
                        name: 'email',
                        as: 'input',
                        rules: 'required|email|max:255',
                        col: 6,
                    },
                    {
                        label: 'Usuario',
                        name: 'username',
                        as: 'input',
                        rules: 'required|max:255',
                        col: 6,
                    },
                    {
                        label: 'Contraseña',
                        id: 'password',
                        name: 'password',
                        as: 'input',
                        type: 'current-password',
                        col: 6,
                    },
                    {
                        label: 'Rol',
                        name: 'roles',
                        labelField: 'name',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        multiple: true,
                        optionsUrl: '/api/roles'
                    },
                    {
                        label: 'Generar contraseña aleatoria',
                        name: 'isRandomPassword',
                        as: 'checkbox',
                        type: 'checkbox',
                        col: 3,
                    },
                    {
                        label: 'Enviar contraseña por correo electrónico',
                        name: 'isSendPassword',
                        as: 'checkbox',
                        type: 'checkbox',
                        col: 3,
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
            const apiUrl = '/api/users';
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
            modalFormLocalUserCreate.value.title = 'Modificar usuario: ' + item.name;
            modalFormLocalUserCreate.value.formSchema.submitText = 'Actualizar usuario';
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
            axios.put(`${apiUrl}/${id}`, { deleted_at: null}).then(() => {
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
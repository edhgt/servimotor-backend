<template>
    <div class="row mb-2">
        <div class="col-12">
            <button class="btn btn-primary float-end" @click="create">
                <i class="bi bi-person-up"></i>
                Agregar usuario
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
                <template #deleted_at="{ value }">
                    <span class="badge text-bg-success" v-if="value == null">Activo</span>
                    <span class="badge text-bg-danger" v-else>Inactivo</span>
                </template>
                <template #actions="{ item, index }">
                    <button type="button" class="btn btn-primary btn-sm" title="Modificar usuario" @click="edit(item, index)">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" title="Deshabilitar usuario" @click="destroy(item, index)" v-if="item.deleted_at == null">
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
        id="modalImportUser"
        :title="modalImportUser.title"
        size="xl"
        v-model="modalImportUser.isVisible"
        :scrollable="true"
        >
        <Form autocomplete="off" action="" @submit="searchUsers">
            <div class="row mb-2">
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="type">Tipo de búsqueda</label>
                    <Field id="type" name="type" label="tipo de búsqueda" rules="required" v-slot="{ field }">
                        <v-select :options="ldapSearch.types" v-bind="field" v-model="field.value"></v-select>
                    </Field>
                    <ErrorMessage name="type"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-md-6">
                    <label class="form-label" for="value">Valor</label>
                    <Field type="text" id="value" name="value" class="form-control" label="valor" rules="required"></Field>
                    <ErrorMessage name="value"></ErrorMessage>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" @click="">Buscar</button>
        </Form>
        <div v-if="ldapSearch.searching" class="mt-3">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p>Buscando usuarios</p>
        </div>
        <table class="table table-striped table-hover" v-else-if="state.ldapUsers.length > 0">
            <thead>
                <tr>
                <td>#</td>
                <td>Nombre</td>
                <td>Descripción</td>
                <td>Correo</td>
                <td></td>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(ldapUser, i) of state.ldapUsers" :key="i">
                <td>{{ i + 1 }}</td>
                <td>{{ ldapUser.name }}</td>
                <td>{{ ldapUser.description }}</td>
                <td>{{ ldapUser.email }}</td>
                <td>
                    <button class="btn btn-success" @click="store(ldapUser, i)">
                        <i class="bi bi-person-add"></i>
                        Agregar
                    </button>
                </td>
                </tr>
            </tbody>
        </table>
    </Modal>

    <Modal
        id="modalFormUser"
        :title="modalFormUser.title"
        size="xl"
        v-model="modalFormUser.isVisible"
        :scrollable="true"
        >
        <form @submit="update">
            <div class="row">
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" name="name" class="form-control disabled" disabled :value="user?.name">
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="description">Descripción</label>
                    <input type="text" id="description" name="description" class="form-control disabled" disabled :value="user?.description">
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="form-control disabled" disabled :value="user?.email">
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="username">Usuario</label>
                    <input type="email" id="username" name="username" class="form-control disabled" disabled :value="user?.username">
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="cui">Cui <small class="text-muted">(opcional)</small></label>
                    <Field type="tel" id="cui" name="cui" class="form-control"/>
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="cui">Fecha de cumpleaños <small class="text-muted">(opcional)</small></label>
                    <Field type="date" id="birthday" name="birthday" class="form-control"/>
                </div>
                <div class="col-sm-12 col-md-6 mb-3">
                    <label for="roles">Rol</label>
                    <Field v-slot="{ field }" id="roles" name="roles" label="rol" rules="required">
                        <Select v-bind="field" v-model="field.value" url="/api/roles" :multiple="true"></Select>
                    </Field>
                    <ErrorMessage name="roles"></ErrorMessage>
                </div>
                <div class="col-sm-12 col-md-6 my-auto">
                    <div class="form-check mb-3">
                        <Field v-slot="{ field }" name="is_director" type="checkbox" label="es director" :value="true" :unchecked-value="false">
                            <input type="checkbox" id="is_director" class="form-check-input" name="is_director" v-bind="field" :value="true" />
                            <label class="form-check-label" for="is_director">
                                Es director <br>
                                <ErrorMessage name="is_director"></ErrorMessage>
                            </label>
                        </Field>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Actualizar</button>
        </form>
    </Modal>

</template>

<script>
import { onMounted, reactive, ref } from "vue";
import { Form, Field, ErrorMessage, useForm} from 'vee-validate';
import { useToast } from "vue-toastification";
import VueSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import SimplePaginatedTable from "@/components/SimplePaginatedTable.vue";
import Modal from "@/components/Modal.vue";
import Select from "@/components/Select.vue";

export default {
    name: 'Users',
    components: {
        Form, Field, ErrorMessage,
        'v-select': VueSelect,
        SimplePaginatedTable,
        Modal,
        Select,
    },
    setup() {
        const toast = useToast();
        const apiUrl = '/api/users';
        const state = reactive({
            laravelResponse: {per_page: 5, data: []},
            ldapUsers: [],
            rolesSelected: [],
        });
        const columns = [
            {key: 'id', label: 'ID'},
            {key: 'name', label: 'Nombre'},
            {key: 'description', label: 'Descripción'},
            {key: 'username', label: 'Usuario'},
            {key: 'email', label: 'Correo electrónico'},
            {key: 'created_at', label: 'Fecha creación'},
            {key: 'updated_at', label: 'Fecha actualiación'},
            {key: 'deleted_at', label: 'Estado'},
        ];
        const {values: userForm, handleSubmit, setFieldValue, setValues, setFieldError, resetForm, resetField} = useForm();

        const modalImportUser = ref({title: 'Importar usuario', isVisible: false});
        const modalFormUser = ref({title: 'Actualizar usuario', isVisible: false});
        const ldapSearch = ref({types: [
            { code: 'samaccountname', label: 'Usuario'},
            { code: 'cn', label: 'Nombre'},
        ], searching: false });
        const user = ref();

        const searchUsers = (values) => {
            ldapSearch.value.searching = true;
            axios.get(apiUrl, {
                params: {
                filter: true,
                type: values.type.code,
                value: values.value
                }
            }).then((response) => {
                state.ldapUsers = response.data;
                ldapSearch.value.searching = false;
            }).catch(() => {
                ldapSearch.value.searching = false;
            })
        };

        const index = (url = undefined) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${state.laravelResponse.per_page}`;
            axios.get(apiUrlIndex).then(response => state.laravelResponse = response.data);
        };
        const create = () => {
            modalImportUser.value.isVisible = true;
            ldapSearch.value.searching = false;
            state.ldapUsers = [];
            resetForm();
        };

        const store = (ldapUser, index) => {
            const confirmStoreUser = confirm(`Desea agregar a ${ldapUser.name} <${ldapUser.email}>`)
            if (!confirmStoreUser) return;
            const apiUrl = '/api/users';
            axios.post(apiUrl, ldapUser)
            .then(response => {
                state.laravelResponse.data.unshift(response.data);
                resetForm();
                state.ldapUsers.splice(index, 1);
                toast.success(`Se sincronizó el usuario ${response.data.name} <${response.data.email}>`);
                edit(response.data, 0);
            })
        };

        const getRolesByUserId = (id) => {
            axios.get(`${apiUrl}/${id}`, {params: { roles: true}}).then(response => {
                const roles = response.data.map(r => r.id);
                if(roles.length > 0) {
                    setFieldValue('roles', roles);
                }
            });
        }

        const edit = (item, index) => {
            resetForm();
            user.value = item;
            setValues(user.value);
            setFieldValue('index', index);
            setFieldValue('is_director', Boolean(user.value.is_director));
            getRolesByUserId(user.value.id);
            modalImportUser.value.isVisible = false;
            modalFormUser.value.isVisible = true;
        };

        const update = handleSubmit(() => {
            axios.patch(`${apiUrl}/${userForm.id}`, userForm)
            .then(response => {
                state.laravelResponse.data[userForm.index] = response.data;
                toast.info(`Usuario ${userForm.name} <${userForm.email}> actualizado`);
                    modalFormUser.value.isVisible = false;
            })
            .catch(error => {
                if (error.response.data.errors) {
                    Object.entries(error.response.data.errors).forEach(([key, value]) => {
                        setFieldError(key, value);
                    });
                }
            });

        });

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
            modalImportUser,
            modalFormUser,
            ldapSearch,
            user,
            searchUsers,
            index,
            create,
            store,
            edit,
            update,
            destroy,
            restore
        };
    }
}
</script>
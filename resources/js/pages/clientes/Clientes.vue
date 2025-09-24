<template>
    <div class="row mb-2">
        <div class="col-12">
            <div class="btn-group float-end">
                <button class="btn btn-outline-primary" @click="create" v-can="'clientes.create'">
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
                    <button type="button" class="btn btn-primary btn-sm" title="Modificar cliente" @click="edit(item, index)" v-can="'clientes.edit'">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" title="Deshabilitar cliente" @click="destroy(item, index)" v-if="item.deleted_at == null" v-can="'clientes.delete'">
                        <i class="bi bi-trash"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" title="Habilitar cliente" @click="restore(item.id, index)" v-else>
                        <i class="bi bi-check-square"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" title="Agregar vehículo" @click="agregarVehiculo(item.id)" v-can="'clientes.agregar-vehiculo'">
                        <i class="bi bi-plus-circle"></i> Agregar vehículo
                    </button>
                </template>
            </SimplePaginatedTable>
        </div>
    </div>

    <Modal
        id="modalFormLocalClienteCreate"
        :title="modalFormLocalClienteCreate.title"
        size="lg"
        v-model="modalFormLocalClienteCreate.isVisible"
        >
        <DynamicForm :schema="modalFormLocalClienteCreate.formSchema" :initialValues="modalFormLocalClienteCreate.initialValues" :is-reset-form="modalFormLocalClienteCreate.isResetForm" :errors="modalFormLocalClienteCreate.errors" @submit="submit" />
    </Modal>

    <Modal
        id="modalFormVehiculo"
        :title="modalFormVehiculo.title"
        size="lg"
        v-model="modalFormVehiculo.isVisible"
        >
        <DynamicForm :schema="modalFormVehiculo.formSchema" :initialValues="modalFormVehiculo.initialValues" :is-reset-form="modalFormVehiculo.isResetForm" :errors="modalFormVehiculo.errors" @submit="submitVehiculo" />
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
            {key: 'correo', label: 'Correo electrónico'},
            {key: 'created_at', label: 'Fecha creación'},
            {key: 'updated_at', label: 'Fecha actualiación'},
        ];

        const modalFormLocalClienteCreate = ref({
            title: 'Nuevo cliente',
            isVisible: false,
            isResetForm: false,
            initialValues: {},
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
                        label: 'Correo electrónico',
                        name: 'correo',
                        type: 'email',
                        as: 'input',
                        rules: 'email|max:255',
                        col: 12,
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

        const modalFormVehiculo = ref({
            title: 'Nuevo vehículo',
            isVisible: false,
            isResetForm: false,
            initialValues: {
                cliente_id: undefined,
            },
            formSchema: {
                title: 'Datos generales',
                submitText: 'Registrar vehículo',
                fields: [
                    {
                        label: 'Vin',
                        name: 'vin',
                        as: 'input',
                        col: 6,
                    },
                    {
                        label: 'Placa',
                        name: 'placa',
                        as: 'input',
                        rules: 'required',
                        col: 6,
                    },
                    {
                        label: 'Año',
                        name: 'anio',
                        type: 'number',
                        as: 'input',
                        step: '1',
                        rules: 'required|integer',
                        col: 6,
                    },
                    {
                        label: 'Marca',
                        name: 'marca_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/marcas'
                    },
                    {
                        label: 'Modelo',
                        name: 'modelo_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/modelos'
                    },
                    {
                        label: 'Color',
                        name: 'color_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/colores'
                    },
                    {
                        label: 'Tipo vehículo',
                        name: 'tipo_vehiculo_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/tipos-vehiculo'
                    },
                    {
                        label: 'Tipo motor',
                        name: 'tipo_motor_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/tipos-motor'
                    },
                    {
                        label: 'Tipo transmisión',
                        name: 'tipo_transmision_id',
                        as: 'select',
                        rules: 'required',
                        col: 6,
                        optionsUrl: '/api/tipos-transmision'
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
            modalFormLocalClienteCreate.value.isVisible = true;
        };

        const agregarVehiculo = (clienteId) => {
            modalFormVehiculo.value.cliente_id = clienteId;
            modalFormVehiculo.value.isVisible = true;
        };

        const submit = (values) => {
            if(values.id) {
                update(values);
            } else {
                store(values);
            }
        };

        const submitVehiculo = (values) => {
            axios.post(`${apiUrl}/${modalFormVehiculo.value.cliente_id}/vehiculos`, values)
            .then(response => {
                toast.success(`Vehículo creado correctamente`);
                modalFormVehiculo.value.isVisible = false;
                modalFormVehiculo.value.isResetForm = true;
            }).catch(errors => {
                modalFormVehiculo.value.errors = errors.response.data.errors;
            });
        };

        const store = (values) => {
            axios.post(apiUrl, values)
            .then(response => {
                toast.success(`Cliente ${response.data.name} <${response.data.email}> creado correctamente`);
                state.laravelResponse.data.unshift(response.data);
                modalFormLocalClienteCreate.value.isVisible = false;
                modalFormLocalClienteCreate.value.isResetForm = true;
            }).catch(errors => {
                modalFormLocalClienteCreate.value.errors = errors.response.data.errors;
            });
        };

        const edit = (item, index) => {
            modalFormLocalClienteCreate.value.isVisible = true;
            modalFormLocalClienteCreate.value.isResetForm = true;
            modalFormLocalClienteCreate.value.initialValues = {
                ...modalFormLocalClienteCreate.value.initialValues,
                ...item,
            };
            modalFormLocalClienteCreate.value.title = 'Modificar cliente: ' + item.nombre_completo;
            modalFormLocalClienteCreate.value.formSchema.submitText = 'Actualizar cliente';
            modalFormLocalClienteCreate.value.initialValues.index = index;
            modalFormLocalClienteCreate.value.initialValues.id = item.id;

        };

        const update = (values) => {
            axios.patch(`${apiUrl}/${values.id}`, values)
            .then(response => {
                state.laravelResponse.data[modalFormLocalClienteCreate.value.index] = response.data;
                modalFormLocalClienteCreate.value.isVisible = false;
                toast.info(`Usuario ${values.name} <${values.email}> actualizado`);
            })
            .catch(error => {
                modalFormLocalClienteCreate.value.errors = errors.response.data.errors;
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
            modalFormLocalClienteCreate,
            modalFormVehiculo,
            index,
            create,
            agregarVehiculo,
            submit,
            submitVehiculo,
            edit,
            destroy,
            restore
        };
    }
}
</script>
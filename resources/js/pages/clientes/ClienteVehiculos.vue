<template>
    <div>
        <SimplePaginatedTable :laravel-response="vehiculos" :columns="columns" @change-page="index">
            <template #actionTitle>Acciones</template>
            <template #actions="{ item, index }">
                <button class="btn btn-secondary" title="Modificar" @click="edit(item, index)"
                    v-can="'vehiculos.edit'">
                    <i class="bi bi-pencil-square"></i>
                </button>
                <!-- <button class="btn btn-danger ms-2" title="Eliminar" @click="destroy(item, index)"
                    v-if="item.deleted_at == null" v-can="permission + '.destroy'">
                    <i class="bi bi-trash"></i>
                </button>
                <button class="btn btn-success ms-2" title="Habilitar" @click="restore(item.id, index)" v-else>
                    <i class="bi bi-check-circle"></i>
                </button> -->
            </template>
        </SimplePaginatedTable>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import SimplePaginatedTable from '@/components/SimplePaginatedTable.vue';

export default {
    components: {
        SimplePaginatedTable,
    },
    setup() {
        const route = useRoute();
        const apiUrl = `/api/clientes/${route.params.id}/vehiculos`;
        const vehiculos = ref({ meta: { per_page: 5}, data: [], links: { prev: null, next: null }});
        const columns = [
            {key: 'id', label: 'Id'},
            {key: 'vin', label: 'Vin'},
            {key: 'placa', label: 'Placa'},
            {key: 'anio', label: 'Año'},
            {key: 'marca', label: 'Marca'},
            {key: 'modelo', label: 'Modelo'},
            {key: 'color', label: 'Color'},
            {key: 'tipo_vehiculo', label: 'Tipo'},
            {key: 'tipo_motor', label: 'Motor'},
            {key: 'tipo_transmision', label: 'Transmisión'},
        ];

        const index = (url) => {
            const apiUrlIndex = url ? url : `${apiUrl}?per_page=${vehiculos.value.meta.per_page}`;
            axios.get(apiUrlIndex).then(response => {
                vehiculos.value = response.data;
            });
        }

        // const destroy = () => {
        //     axios.delete(`${apiUrl}/${id}`).then(response => {
        //         cliente.value.deleted_at = new Date();
        //     });
        // }

        // const restore = () => {
        //     axios.put(`${apiUrl}/${id}`, { deleted_at: null }).then(response => {
        //         cliente.value.deleted_at = null;
        //     });
        // }

        onMounted(() => {
            index();
        });
        return {
            columns,
            vehiculos,
            index,
            // destroy,
            // restore,
        };
    }

}
</script>
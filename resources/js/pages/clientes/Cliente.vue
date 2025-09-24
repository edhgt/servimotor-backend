<template>
    <div>
        <div class="d-flex justify-content-between">
            <h4>{{ cliente.nombre_completo }}</h4>
            <button class="btn btn-outline-danger" @click="destroy" v-if="cliente.deleted_at == null">Eliminar</button>
            <button class="btn btn-outline-success" @click="restore" v-else>Reestablecer</button>
        </div>
        <ul class="nav nav-underline mb-3">
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'clientes.show' }" exact-active-class="active" active-class="active">Detalles</router-link>
            </li>
            <li class="nav-item">
                <router-link class="nav-link" :to="{ name: 'clientes.vehiculos' }" exact-active-class="active" active-class="active">Vehiculos</router-link>
            </li>
        </ul>
        <table class="table table-striped-columns" v-if="route.name == 'clientes.show'">
            <tbody>
                <tr v-for="(value, key) in cliente" :key="key">
                    <td width="15%">{{ key }}</td>
                    <td>{{ value }}</td>
                </tr>
            </tbody>
        </table>
        <router-view v-else></router-view>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

export default {
    setup() {
        const apiUrl = '/api/clientes';
        const cliente = ref({
            id: null,
            nombre_completo: '',
            deleted_at: null,
        });
        const route = useRoute();
        const id = route.params.id;

        const show = () => {
            axios.get(`${apiUrl}/${id}`).then(response => {
                cliente.value = response.data;
            });
        }

        const destroy = () => {
            axios.delete(`${apiUrl}/${id}`).then(response => {
                cliente.value.deleted_at = new Date();
            });
        }

        const restore = () => {
            axios.put(`${apiUrl}/${id}`, { deleted_at: null }).then(response => {
                cliente.value.deleted_at = null;
            });
        }

        onMounted(() => {
            show();
        });
        return {
            route,
            cliente,
            destroy,
            restore,
        };
    }

}
</script>
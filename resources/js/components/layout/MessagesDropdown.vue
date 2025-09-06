<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-bs-toggle="dropdown" href="#">
            <i class="bi bi-chat-text"></i>
            <span class="navbar-badge badge text-bg-danger">{{documentos.length}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
            <template v-for="documento in documentos" :key="documento.code">
                <a href="#" class="dropdown-item" :title="documento.descripcion">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h3 class="dropdown-item-title">
                                {{documento.correlativo}}
                            </h3>
                            <div class="fs-7 d-inline-block text-truncate" style="max-width: 270px;">
                                {{documento.descripcion}}
                            </div>
                            <p class="fs-7 text-secondary">
                                <i class="bi bi-clock-fill me-1"></i> {{formatRelativeTime(documento.fecha)}}
                            </p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            </template>
            <a href="#" class="dropdown-item dropdown-footer">Ver todos los documentos</a>
        </div>
    </li>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { formatRelativeTime } from '../../utils/dateUtils';

const documentos = ref([]);
const obtenerDocumentosSinRecibir = () => {
    axios.get('/api/documentos-sin-aceptar').then(response => {
        documentos.value = response.data;
    })
};

onMounted(() => {
    obtenerDocumentosSinRecibir();
})
</script>
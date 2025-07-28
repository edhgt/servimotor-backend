<template>
    <div class="btn-group" v-if="type == 'buttons'">
        <template v-if="!isFileUploaded">
            <button class="btn btn-outline-primary" aria-label="Generar PDF" @click="generar(documento)"
                v-if="documento.destinatario_id && isActive">
                <i class="bi bi-file-pdf"></i> Generar PDF
            </button>
    
            <router-link class="btn btn-outline-primary" :to="{ name: 'ModificarDocumento', params: { id: documento.id } }"
                aria-label="Modificar documento" v-if="!isEdit && isActive">
                <i class="bi bi-pencil-square"></i> Modificar
            </router-link>
        </template>

        <a class="btn btn-outline-primary" :href="'/storage/' + documento.archivos[0].path" target="_blank" aria-label="Descargar documento"
            v-if="documento.archivos.length > 0">
            <i class="me-1 fs-6 bi bi-download text-primary"></i> Descargar
        </a>

        <a class="btn btn-outline-primary" :href="documento.file_referencia_url" target="_blank"
            aria-label="Ver referencia" v-if="documento.file_referencia_url">
            <i class="me-1 fs-6 bi bi-paperclip text-danger"></i> Referencia
        </a>

        <router-link class="btn btn-outline-primary" :to="{ name: 'SubirDocumento', params: { id: documento.id } }"
            aria-label="Subir documento" v-if="isActive && !isRouteUploaded">
            <i class="bi bi-upload"></i> Subir
        </router-link>

        <button class="btn btn-outline-secondary" aria-label="Archivar documento" @click="archivar(documento)"
            v-if="isActive">
            <i class="bi bi-file-pdf"></i> Archivar
        </button>

        <button class="btn btn-outline-danger" aria-label="Eliminar documento" @click="eliminar(documento)"
            v-if="isActive">
            <i class="bi bi-file-pdf"></i> Eliminar
        </button>
    </div>
    <Dropleft v-else>
        <template #dropdownItem>
            <template v-if="!isFileUploaded">
                <a href="#" class="dropdown-item" aria-label="Generar PDF" @click="generar(documento)"
                    v-if="documento.destinatario_id && isActive">
                    <i class="me-1 fs-6 bi bi-file-pdf text-danger"></i> Generar PDF
                </a>
    
                <router-link class="dropdown-item" :to="{ name: 'ModificarDocumento', params: { id: documento.id } }"
                    aria-label="Modificar documento" v-if="!isEdit && isActive">
                    <i class="me-1 fs-6 bi bi-pencil-square text-primary"></i> Modificar
                </router-link>
            </template>

            <a class="dropdown-item" :href="'/storage/' + documento.archivos[0].path" target="_blank" aria-label="Descargar documento"
                v-if="documento.archivos.length > 0">
                <i class="me-1 fs-6 bi bi-download text-primary"></i> Descargar documento
            </a>

            <a class="dropdown-item" :href="documento.file_referencia_url" target="_blank"
                aria-label="Ver referencia" v-if="documento.file_referencia_url">
                <i class="me-1 fs-6 bi bi-paperclip text-danger"></i> Descargar Referencia
            </a>

            <router-link class="dropdown-item" :to="{ name: 'SubirDocumento', params: { id: documento.id } }"
                aria-label="Subir documento" v-if="isActive && !isRouteUploaded">
                <i class="me-1 fs-6 bi bi-upload text-primary"></i> Adjuntar o reemplazar
            </router-link>

            <a href="#" class="dropdown-item" aria-label="Archivar documento" @click="archivar(documento)"
                v-if="isActive">
                <i class="me-1 fs-6 bi bi-archive text-secondary"></i> Archivar
            </a>

            <a href="#" class="dropdown-item text-danger me-1" aria-label="Eliminar documento" @click="eliminar(documento)"
                v-if="isActive">
                <i class="me-1 fs-6 bi bi-trash"></i> Eliminar
            </a>
        </template>
    </Dropleft>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import { useDocumentos } from '@/composables/useDocumento';
import Dropleft from '@/components/Dropleft.vue';

const props = defineProps({
  type: {
    type: String,
    required: true,
    validator: (value) => ['buttons', 'dropleft'].includes(value),
    default: 'buttons'
  },
  documento: {
    type: Object,
    default: () => ({
      id: null,
      file_url: null,
      file_referencia_url: null,
      deleted_at: null,
    }),
  },
});

const { generar, archivar, eliminar } = useDocumentos();
const route = useRoute();

const CARGADO = 2;
const ARCHIVADO = 3;
const ELIMINADO = 4;

const isEdit = computed(() => route.name === 'ModificarDocumento');
const isRouteUploaded = computed(() => route.name === 'SubirDocumento');
const isArchived = computed(() => props.documento.estado_documento_id === ARCHIVADO);
const isDeleted = computed(() => props.documento.estado_documento_id === ELIMINADO);
const isFileUploaded = computed(() => props.documento.estado_documento_id === CARGADO);
const isActive = computed(() => !isArchived.value && !isDeleted.value);
</script>

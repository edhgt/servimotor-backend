<template>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ documento?.correlativo }}</h3>
            <div class="card-tools">
                <documento-actions-component :documento="documento" type="dropleft" v-if="documento" />
            </div>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <b>Tipo: </b>
                    {{ documento?.tipo_documento?.name }}
                </li>
                <li class="list-group-item">
                    <b>Asunto: </b>{{ documento?.asunto }}
                </li>
                <li class="list-group-item">
                    <b>Creado por: </b>
                    {{ documento?.user?.name }}
                </li>
                <li class="list-group-item">
                    <b>Fecha creación: </b>
                    {{ documento?.created_at }}
                </li>
                <li class="list-group-item">
                    <span :class="estadosColor[documento?.estado_documento_id]?.color">{{ estadosColor[documento?.estado_documento_id]?.label }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import { ref } from 'vue';
import DocumentoActionsComponent from '@/components/DocumentoActionsComponent.vue';

export default {
    name: 'DocumentoDetailsComponent',
    components: {
        DocumentoActionsComponent
    },
    props: {
        documento: { type: Object, required: false }
    },
    setup() {
        const estadosColor = ref({
            1: {color: 'badge text-bg-warning', label: 'Pendiente de adjuntar'},
            2: {color: 'badge text-bg-success', label: 'Documento cargado'},
            3: {color: 'badge text-bg-secondary', label: 'Archivado'},
            4: {color: 'badge text-bg-danger', label: 'Eliminado'},
        });
        
        return {
            estadosColor
        };
    }
}
</script>
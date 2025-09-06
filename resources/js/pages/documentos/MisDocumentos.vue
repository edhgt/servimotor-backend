<template>
    <DocumentosComponent url="/api/documentos" filtrar-por="mis-documentos" />
</template>

<script>
import DocumentosComponent from '@/components/DocumentosComponent.vue';

export default {
    name: 'MisDocumentosComponent',
    components: {
        DocumentosComponent,
    },
}
</script>
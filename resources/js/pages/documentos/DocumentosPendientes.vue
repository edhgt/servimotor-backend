<template>
    <DocumentosComponent url="/api/documentos" filtrar-por="documentos-pendientes" />
</template>

<script>
import DocumentosComponent from '@/components/DocumentosComponent.vue';

export default {
    name: 'MisDocumentos',
    components: {
        DocumentosComponent,
    },
}
</script>
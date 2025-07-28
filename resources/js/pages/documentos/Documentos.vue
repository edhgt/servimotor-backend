<template>
  <DocumentosComponent url="/api/documentos" filtrar-por="documentos"/>
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
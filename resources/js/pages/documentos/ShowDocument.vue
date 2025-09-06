<template>
    <documento-details-component :documento="documento" />
</template>

<script>
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import DocumentoDetailsComponent from '@/components/DocumentoDetailsComponent.vue';

export default {
    name: 'ShowDocument',
    components: {
        DocumentoDetailsComponent,
    },
    setup() {
        const route = useRoute();
        const router = useRouter();
        const documento = ref();

        const show = () => {
            axios.get('/api/documentos/' + route.params.id).then(response => {
                documento.value = response.data;
            }).catch(() => {
                router.back();
            });
        }

        onMounted(() => {
            show();
        });
        
        return {
            documento,
        }
    }
}
</script>
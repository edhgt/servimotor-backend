<template>
    <CatalogoComponent
        api-url="/api/entidades"
        title="entidad"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Entidades',
    components: {
        CatalogoComponent
    },
}
</script>
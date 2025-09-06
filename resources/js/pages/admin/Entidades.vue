<template>
    <CatalogoComponent
        api-url="/api/entidades"
        title="entidad"
        permission="entidades"
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
<template>
    <CatalogoComponent
        api-url="/api/dependencias"
        title="dependencia"
        permission="dependencias"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Dependencias',
    components: {
        CatalogoComponent
    },
}
</script>
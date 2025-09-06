<template>
    <CatalogoComponent
        api-url="/api/cargos"
        title="cargo"
        permission="cargos"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Cargos',
    components: {
        CatalogoComponent
    },
}
</script>
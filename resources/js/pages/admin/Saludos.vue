<template>
    <CatalogoComponent
        api-url="/api/saludos"
        title="saludo"
    />
</template>

<script>
import CatalogoComponent from '../../components/CatalogoComponent.vue';
export default {
    name: 'Saludos',
    components: {
        CatalogoComponent
    },
}
</script>
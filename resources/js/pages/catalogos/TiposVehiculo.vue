<template>
    <CatalogoComponent
        api-url="/api/tipos-vehiculo"
        title="tipo de vehiculo"
        :columns="columns"
        permission="tipos-vehiculo"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Tipos de vehículo',
    components: {
        CatalogoComponent
    },
    setup() {
        const columns = [
            {key: 'id', label: 'Id'},
            {key: 'nombre', label: 'Nombre', name: 'nombre', rules: 'required', as: 'input', thStyle: 'width:60%;'},
        ];
        return {
            columns,
        };
    }
}
</script>
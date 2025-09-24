<template>
    <CatalogoComponent
        api-url="/api/servicios"
        title="servicio"
        :columns="columns"
        permission="servicios"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Servicios',
    components: {
        CatalogoComponent
    },
    setup() {
        const columns = [
            {key: 'id', label: 'Id'},
            {key: 'nombre', label: 'Nombre', name: 'nombre', rules: 'required', as: 'input'},
            {key: 'descripcion', label: 'Descripción', name: 'descripcion', rules: 'required', as: 'input'},
            {key: 'precio_estandar', label: 'Precio estándar', name: 'precio_estandar', rules: 'required', as: 'number', step: '0.01'},
        ];
        return {
            columns,
        };
    }
}
</script>
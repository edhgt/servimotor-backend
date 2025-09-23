<template>
    <CatalogoComponent
        api-url="/api/colores"
        title="color"
        :columns="columns"
        permission="colores"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Colores',
    components: {
        CatalogoComponent
    },
    setup() {
        const columns = [
            {key: 'id', label: 'Id'},
            {key: 'nombre', label: 'Nombre', name: 'nombre', rules: 'required', as: 'input', type: 'color', thStyle: 'width:60%;'},
        ];
        return {
            columns,
        };
    }
}
</script>
<template>
    <CatalogoComponent
        api-url="/api/unidades-medida"
        title="unidad de medida"
        :columns="columns"
        permission="unidades-medida"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Unidades de medida',
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
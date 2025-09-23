<template>
    <CatalogoComponent
        api-url="/api/categorias"
        title="categoria"
        :columns="columns"
        permission="categorias"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Categorias',
    components: {
        CatalogoComponent
    },
    setup() {
        const columns = [
            {key: 'id', label: 'Id', name: 'id'},
            {key: 'nombre', label: 'Nombre', name: 'nombre', rules: 'required', as: 'input', thStyle: 'width:60%;'},
        ];
        return {
            columns,
        };
    }
}
</script>
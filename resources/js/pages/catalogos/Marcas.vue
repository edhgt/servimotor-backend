<template>
    <CatalogoComponent
        api-url="/api/marcas"
        title="marca"
        :columns="columns"
        permission="marcas"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Marcas',
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
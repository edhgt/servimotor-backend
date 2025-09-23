<template>
    <CatalogoComponent
        api-url="/api/tipos-transmision"
        title="tipo de transimisión"
        :columns="columns"
        permission="tipos-transimision"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Tipos de transimisión',
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
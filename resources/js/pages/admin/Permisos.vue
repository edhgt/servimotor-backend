<template>
    <CatalogoComponent
        api-url="/api/permissions"
        title="permiso"
        :columns="columns"
        permission="permissions"
    />
</template>

<script>
import CatalogoComponent from '@/components/CatalogoComponent.vue';
export default {
    name: 'Permisos',
    components: {
        CatalogoComponent
    },
    setup() {
        const columns = [
            {key: 'id', label: 'ID'},
            {key: 'nombre', label: 'Nombre',thStyle: 'width:60%;'},
            {key: 'guard_name', label: 'Guard name', thStyle: 'width:20%;'},
        ];
        return {
            columns,
        };
    }
}
</script>
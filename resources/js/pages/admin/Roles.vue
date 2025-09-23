<template>
    <CatalogoComponent
        api-url="/api/roles"
        title="rol"
        :columns="columns"
        permission="roles"
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
            {key: 'id', label: 'Id'},
            {key: 'name', label: 'Nombre', name: 'name', rules: 'required', as: 'input', thStyle: 'width:60%;'},
            {key: 'guard_name', label: 'Guard name', name: 'guard_name', rules: 'required', as: 'input', thStyle: 'width:20%;'},
            {key: 'permissions', label: 'Permisos', labelField: 'name', name: 'permissions', rules: 'required', as: 'select', multiple: true, optionsUrl: '/api/permissions', thStyle: 'width:20%;'},
        ];
        return {
            columns,
        };
    }
}
</script>
<template>
    <SimplePaginatedTable
        :laravel-response="laravelResponse"
        :columns="columns"
    >
        <template #actions="{ item }">
            <button class="btn btn-primary">Editar</button>
        </template>
    </SimplePaginatedTable>
</template>
<script>
import { reactive, ref } from 'vue';
import { SimplePaginatedTable } from '@/components/SimplePaginatedTable.vue';
import { Modal } from '@/components/Modal.vue';


export default {
    name: 'Dependencias',
    components: {
        Modal,
        SimplePaginatedTable,
    },
    setup() {
        const modal = ref({
            title: '',
            isVisible: false,
            mode: 'create'
        });
        const laravelResponse = reactive({
            per_page: 5,
            data: []
        })
        const columns = [
            { key: 'id', label: 'ID'},
            { key: 'name', label: 'Dependencia'},
        ];

        const create = () => {};
        const store = () => {};
        const edit = () => {};
        const update = () => {};
        const destroy = () => {};

        return {
            modal,
            laravelResponse,
            columns,
            create,
            store,
            edit,
            update,
            destroy,
        };
    }
}
</script>
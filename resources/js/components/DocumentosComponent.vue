<template>
    <div class="row mb-3">
        <div class="col-sm-12 col-md-12 col-lg-4">
            <Select v-model="tipoDocumento" url="/api/tipo-documentos"/>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <SimplePaginatedTable
                :laravel-response="state.laravelResponse"
                :columns="state.columns"
                @change-page="getList"
            >
            <template #correlativo="{ value, item }">
                <router-link :to="{ name: 'ShowDocument', params: { id: item.id }}">
                    {{ value }}
                </router-link>
            </template>
            <template #asunto="{ value }">
                <span class="d-inline-block text-truncate" style="max-width: 400px;" :title="value">{{ value }}</span>
            </template>
            <template #estado_documento="{ value, item }">
                <span :class="estadosColor[item.estado_documento_id]">{{ value.name }}</span>
            </template>
            <template #actions="{ item }">
                <documento-actions-component :documento="item" type="dropleft" />
            </template>
            </SimplePaginatedTable>
        </div>
    </div>
</template>

<script>
import { onMounted, reactive, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { useUserStore } from '@/store/user';
import { useDocumentos } from '@/composables/useDocumento';
import SimplePaginatedTable from '@/components/SimplePaginatedTable.vue';
import Select from '@/components/Select.vue';
import Dropleft from '@/components/Dropleft.vue';
import DocumentoActionsComponent from './DocumentoActionsComponent.vue';

export default {
    name: 'MisDocumentosComponent',
    components: {
        SimplePaginatedTable,
        Select,
        Dropleft,
        DocumentoActionsComponent,
    },
    props: {
        url: { type: String, required: true},
        filtrarPor: { type: String, required: true}
    },
    setup(props) {
        const store = useUserStore();
        const route = useRoute();
        const { generar, archivar, eliminar } = useDocumentos();
        const state = reactive({
            laravelResponse: { per_page: 5, data: []},
            columns: [
            {key: 'id', label: 'Id'},
            {key: 'tipo_documento', label: 'Tipo documento'},
            {key: 'correlativo', label: 'Correlativo'},
            {key: 'asunto', label: 'Asunto', thStyle: 'width: 25%'},
            {key: 'user', label: 'Responsable'},
            {key: 'created_at', label: 'Fecha creación'},
            {key: 'estado_documento', label: 'Estado'},
            ]
        });
        
        const tipoDocumento = ref();
        const tipoDocumentos = ref([]);
        const estadosColor = {
            1: 'badge text-bg-warning',
            2: 'badge text-bg-success',
            3: 'badge text-bg-secondary',
            4: 'badge text-bg-danger',
        }

        const getList = (urlPagination) => {
            let apiUrl = urlPagination? urlPagination : props.url;
            apiUrl+= (urlPagination ? '&' : '?') + 'filtrar_por=' + props.filtrarPor;
            axios.get(apiUrl, {
                params: {
                    tipo_documento_id: tipoDocumento.value,
                    per_page: state.laravelResponse.per_page
                }
            })
            .then(response => {
                state.laravelResponse = response.data
            })
        };

        watch(tipoDocumento, () => {
            getList();
        })

        onMounted(() => {
            const tipoDocumentoQueryParam = route.query.type;
            if(tipoDocumentoQueryParam) {
                tipoDocumento.value = Number(tipoDocumentoQueryParam);
            } else {
                tipoDocumento.value = 1;
            }
        });
        return {
            store,
            state,
            tipoDocumento,
            tipoDocumentos,
            estadosColor,
            getList,
            archivar,
            generar,
            eliminar,
        }
    }
}
</script>
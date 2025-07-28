<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        <button class="btn btn-outline-primary" @click="obtenerEstadistica(true)">
                            <i class="bi bi-arrow-repeat"></i>
                            Actualizar
                        </button>
                    </div>
                    <div class="card-tools">
                        <select class="form-select" name="year" id="year" v-model="currentYearSelected" @change="obtenerEstadistica">
                            <option :value="year" v-for="year in years" :key="year">{{ year }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" scope="col">#</th>
                                <th width="65%" scope="col">Tipo documento</th>
                                <th class="text-center" width="15%" scope="col">Emitidos</th>
                                <th class="text-center" width="15%" scope="col">Pendientes de adjuntar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(documento, index) in documentos" :key="documento.tipo_documento">
                                <td>{{ index+1 }}</td>
                                <td>{{ documento.tipo_documento }}</td>
                                <td class="text-center"><span class="badge text-bg-success">{{ documento.actuales }}</span></td>
                                <td class="text-center"><span class="badge text-bg-warning">{{ documento.pendientes }}</span></td>
                            </tr>
                        </tbody>
                        <tr v-if="documentos.length == 0">
                            <td colspan="4" class="text-center">No se encontraron datos</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue'
import { useToast } from 'vue-toastification';

export default {
    name: 'Home',
    setup() {
        const toast = useToast();
        const documentos = ref([]);
        const pendientes = ref([]);
        const actuales = ref([]);
        const currentYear = new Date().getFullYear();
        const currentYearSelected = ref();
        const years = ref([2020]);
        const obtenerEstadistica = (actualizar = false) => {
            documentos.value = [];
            Promise.all([
                axios.get('/api/estadistica/conteo', {
                    params: {
                        column: 'estado_documento_id',
                        value: 1,
                        anio: currentYearSelected.value

                    }
                }),
                axios.get('/api/estadistica/conteo', {
                    params: {
                        column: 'anio',
                        value: currentYearSelected.value
                    }
                }),
                ])
            .then(response => {
                pendientes.value = response[0].data;
                actuales.value = response[1].data;

                actuales.value.forEach(act => {
                    const pendiente = pendientes.value.find(p => p.tipo_documento === act.tipo_documento);
                    documentos.value.push({
                        tipo_documento: act.tipo_documento,
                        actuales: act.total,
                        pendientes: pendiente ? pendiente.total : 0
                    });
                });

                if(actualizar) {
                    toast.info('Información actualizada para el año ' + currentYearSelected.value);
                }
            })
        }



        onMounted(() => {
            currentYearSelected.value = new Date().getFullYear();
            let lastYear = years.value[years.value.length - 1];
            const diffYears = currentYearSelected.value - lastYear;
            for (let index = 0; index < diffYears; index++) {
                lastYear += 1;
                years.value.push(lastYear);
            }
            obtenerEstadistica();
        });

        return {
            currentYear,
            currentYearSelected,
            years,
            documentos,
            obtenerEstadistica,
        }
    },
}
</script>

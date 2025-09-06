<template>
  <div class="row">
    <div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
      <h2 class="text-center fs-2 mt-4">Reportes</h2>
      <h3 class="text-center fs-3">Exportar a formato Excel</h3>
      <div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <div class="card-body">
          <form @submit.prevent="exportarExcel">
            <div class="mb-3">
              <label class="form-label" for="tipoDocumento"
                >Selecciona el tipo de documento</label
              >
              <Field id="tipo" name="tipo" label="tipo de documento" rules="required" v-slot="{field}">
                <v-select v-bind="field" v-model="field.value" :options="tipoDocumentos" label="name" :reduce="tipoDocumento => tipoDocumento.id" multiple></v-select>
              </Field>
              <ErrorMessage name="tipo"></ErrorMessage>
            </div>
            <div class="row mb-3">
              <div class="col-sm-12 col-md-6">
                <label class="form-label" for="fecha_inicial">Fecha inicial</label><br />
                <Field type="date" class="form-control" id="fecha_inicial" name="fecha_inicial" label="fecha inicial" rules="required"/>
                <ErrorMessage name="fecha_inicial"></ErrorMessage>
              </div>
              <div class="col-sm-12 col-md-6">
                <label class="form-label" for="fecha_final">Fecha Final</label><br />
                <Field type="date" class="form-control" id="fecha_final" name="fecha_final" label="fecha final" rules="required"/>
                <ErrorMessage name="fecha_final"></ErrorMessage>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <button
                type="submit"
                class="btn btn-primary"
              >
                <i class="bi bi-download me-2"></i>Exportar reporte
              </button>
              <button
                type="button"
                class="btn btn-sm btn-outline-secondary ms-2"
                @click="resetForm"
              >
                <i class="bi bi-download me-2"></i>Reiniciar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { onMounted, ref } from 'vue';
import VueSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import { useForm, Field, ErrorMessage } from 'vee-validate';
import { useToast } from 'vue-toastification';

export default {
  name: 'Reportes',
  components: {
    Field, ErrorMessage,
    'v-select': VueSelect,
  },
  setup() {
    const toast = useToast();
    const tipoDocumentos = ref([]);
    const { values: reporteForm, handleSubmit, resetForm } = useForm();

    onMounted(() => {
      obtenerTiposDocumentos();
    });

    const obtenerTiposDocumentos = () => {
      axios.get('/api/tipo-documentos', {params: { format: 'vue-select'}})
        .then((response) => {
          tipoDocumentos.value = response.data;
          tipoDocumentos.value.push({id: -1, name: "Todos los tipos de documentos"});
        })
    };

    const exportarExcel = handleSubmit(() => {
      const url = "/api/exportar-excel";
  
      axios
        .get(url, { params: reporteForm, responseType: "blob" })
        .then((response) => {
          toast.success("El reporte se ha generado exitosamente", { position: 'top-center'});
          const blob = new Blob([response.data], {
            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
          });
          const link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);

          let reporteTitle = '';
          const fechaInicial = new Date(reporteForm.fecha_inicial);
          const fechaFinal = new Date(reporteForm.fecha_final);

          const fechaInicialFormateada = new Intl.DateTimeFormat('es-ES').format(fechaInicial);
          const fechaFinalFormateada = new Intl.DateTimeFormat('es-ES').format(fechaFinal);
          if(reporteForm.tipo.length > 1) {
            reporteTitle = 'Reporte de documentos ';
          } else {
            const tipoDocumento = tipoDocumentos.value.find(td => td.id == reporteForm.tipo);
            reporteTitle = `Reporte de ${tipoDocumento.name} `;
          }
          reporteTitle += `del ${fechaInicialFormateada} al ${fechaFinalFormateada}.xlsx`;
          link.setAttribute("download", reporteTitle);
          document.body.appendChild(link);
          link.click();
          link.remove();
          document.body.removeChild(link);
        });
    });

    return {
      tipoDocumentos,
      exportarExcel,
      resetForm
    };
  }
};
</script>

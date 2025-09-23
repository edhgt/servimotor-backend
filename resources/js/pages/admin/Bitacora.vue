<template>
  <div class="card mb-3">
    <div class="card-body">
      <form @submit.prevent="busqueda()">
        <div class="row">
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
            <label class="form-label" for="option">Seleccione una opción de filtro</label>
            <v-select
              v-model="tipoFiltro"
              :options="[
                {code: 'Responsable', label:'Responsable'},
                {code: 'Evento', label:'Tipo de evento'},
                {code: 'MostrarTodo', label:'Mostrar todo'}
              ]"
              @option:selected="actualizarDropdown"
              required
            />
          </div>
          <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6" v-show="tipoFiltro && tipoFiltro.code != 'MostrarTodo'">
            <label class="form-label" for="user">{{opcionesFiltro.label}}</label>
            <v-select
              v-model="valorFiltro"
              :options="opcionesFiltro.options"
              required
            />
          </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">
          <i class="fa fa-search"></i> Buscar
        </button>  
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-12">
      <SimplePaginatedTable
        :laravelResponse="laravelResponse"
        :columns="columns"
        @change-page="busqueda"
        :contain-options="false"
        
      >
        <template #properties="{value, item}">
          <template v-if="item.claves.length > 0">
            <template v-for="clave in item.claves" :key="clave">
              <tr>
                <td style="width: 15%">
                  <strong v-if="item.description == 'deleted'">Anterior:</strong>
                  <strong v-else>{{ clave == "attributes" ? "Nuevo:" : "Anterior:" }}</strong>
                </td>
                <td style="width: 90%">
                  <template v-for="(value, key) in item.properties[clave]" :key="value">
                    <span class="me-2">{{ key }}: {{ value ? value : "null" }}</span>
                  </template>
                </td>
              </tr>
            </template>
          </template>
          <tr v-else>
            <td colspan="2"><strong>Sin propiedades afectadas</strong></td>
          </tr>
        </template>

      </SimplePaginatedTable>
    </div>
  </div>
</template>
<script>
import { ref } from 'vue';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import SimplePaginatedTable from '@/components/SimplePaginatedTable.vue';

export default {
  name: 'Bitacora',
  components: {
    SimplePaginatedTable,
    'v-select': vSelect
  },
  setup() {
    const tipoFiltro = ref();
    const valorFiltro = ref();
    const opcionesFiltro = ref({});
    const laravelResponse = ref({ meta: { per_page: 5}, data: [], links: { prev: null, next: null }});
    const sinResultados = ref(false);
    const columns = [
      { key: 'id', label: 'ID' },
      { key: 'responsable', label: 'Responsable' },
      { key: 'fecha', label: 'Fecha de evento' },
      { key: 'description', label: 'Tipo de evento' },
      { key: 'subject_type', label: 'Tabla' },
      { key: 'properties', label: 'Propiedades afectadas' },
    ];

    const obtenerUltimaPalabra = (cadena) => {
      const partes = cadena.split("\\");
      return partes[partes.length - 1];
    };

    const busqueda = function (url) {
      const apiUrl = url ? url : '/api/bitacora';
      const urlParams = new URLSearchParams();
      urlParams.append("columna", tipoFiltro.value.code);
      urlParams.append("valor", valorFiltro.value?.code);
      urlParams.append("per_page", laravelResponse.value.meta.per_page);
      axios.get(apiUrl, { params: urlParams}).then((response) => {
        laravelResponse.value = response.data;
        laravelResponse.value.data = laravelResponse.value.data.map((bitacora) => {
          console.log(bitacora)
          let properties = typeof bitacora.properties == 'string' ? JSON.parse(bitacora.properties) : bitacora.properties;
          let claves = Object.keys(properties);
          return {
            ...bitacora,
            claves: claves,
            properties: properties,
            subject_type: obtenerUltimaPalabra(bitacora.subject_type),
          };
        });
      }).catch((error) => {
        console.log(error)
        sinResultados.value = true;
      });
    };
    const actualizarDropdown = (item) => {
      valorFiltro.value = undefined;
      if (item.code === "Responsable") {
        opcionesFiltro.value.label = 'Seleccione un usuario';
        axios.get("/api/users?per_page=999").then((response) => {
          opcionesFiltro.value.options = response.data.data.map(u => ({code: u.id, label: u.name}));
        });
      } else if(item.code === "Evento") {
        opcionesFiltro.value.label = 'Seleccione un evento';
        opcionesFiltro.value.options = [
          {code: 'created', label:'Creación'},
          {code: 'updated', label:'Actualización'},
          {code: 'deleted', label:'Eliminación'},
          {code: 'restored', label:'Restauración'},
        ];
      }
    };
    const exportarExcel = () => {
      const url = '/api/exportar-bitacora';
      const params = {
        columna: tipoFiltro,
        valor: consulta.valor,
        per_page: per_page,
      };
       axios
        .get(url, { params, responseType: "blob" })
        .then((response) => {
          const blob = new Blob([response.data]);
          const link = document.createElement("a");
          link.href = window.URL.createObjectURL(blob);
          link.setAttribute("download", "ReporteBitacora.xlsx");
          document.body.appendChild(link);
          link.click();
          document.body.removeChild(link);

          exportacionFinalizada();
        })
        .catch((error) => {
          console.error("Error al exportar a Excel:", error);
          errorExportacion();
        });
    };
    const exportacionFinalizada = () => {
      Swal.fire({
        title: "Exportación finalizada",
        text: "El archivo se ha descargado exitosamente",
        icon: "success"
      })
    };
    const errorExportacion = () => {
      Swal.fire({
        title: "Error al descargar",
        text: "Hubo un problema al descargar el archivo",
        icon: "error",
      })
    }

    return {
      tipoFiltro,
      valorFiltro,
      opcionesFiltro,
      laravelResponse,
      columns,
      busqueda,
      actualizarDropdown,
      exportarExcel,
    };
  },
  data() {
    return {
      
    };
  },
};
</script>

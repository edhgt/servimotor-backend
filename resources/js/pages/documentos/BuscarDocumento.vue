<template>
	<div class="container-fluid">
		<h2 class="text-center display-4 mt-4">Búsqueda de documentos</h2>
		<div class="row mb-3">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<form v-on:submit.prevent="search()">
					<div class="input-group input-group-lg">
						<Field type="search" class="form-control form-control-lg" placeholder="Introduzca el asunto o correlativo del documento" name="query" label="campo de búsqueda" rules="required" style="text-align: center;" />
						<ErrorMessage name="query" />
						<button type="submit" class="btn btn-lg btn-default">
							<i class="bi bi-search"></i>
						</button>
					</div>
				</form>
				</div>
			</div>
		<div class="row" v-if="documentos.data.length > 0">
			<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="form-group mb-3">
					<label for="f">Filtrar resultado</label>
					<input class="form-control" id="f" type="text" v-model="filterText" >
				</div>
				<table class="table table-hover table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Tipo</th>
							<th>Correlativo</th>
							<th>Asunto</th>
							<th>Creado por</th>
							<th>Fecha creación</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="documento in filter">
							<td>{{ documento.id }}</td>
							<td width="15%">{{ documento.tipo_documento.name }}</td>
							<td width="15%">{{ documento.correlativo }}</td>
							<td width="20%" :title="documento.asunto"><span class="d-inline-block text-truncate" style="max-width: 300px;">{{ documento.asunto }}</span></td>
							<td width="15%">{{ documento.user.name }}</td>
							<td>{{ formatDateWithHour(documento.created_at) }}</td>
							<td>{{ documento.estado_documento.name }}</td>
							<td width="4%"><documento-actions-component :documento="documento" type="dropleft" /></td>
						</tr>
					</tbody>
				</table>
				<Pagination :from="documentos.from" :to="documentos.to" :per-page="documentos.per_page" :prev-page-url="documentos.prev_page_url" :next-page-url="documentos.next_page_url" @change-page="search"></Pagination>
			</div>
		</div>
		<div class="alert alert-warning" role="alert" v-if="sinResultados">
			Ningún documento coincide con el parámetro de búsqueda
		</div>
	</div>
</template>
<script>
import { computed, ref } from 'vue'
import { Form, Field, ErrorMessage } from 'vee-validate';
import Pagination from "@/components/Pagination.vue";
import DocumentoActionsComponent from '@/components/DocumentoActionsComponent.vue';
import { formatDateWithHour } from "@/utils/dateUtils";

	export default {
		name: 'BuscarDocumento',

		components: {
			Pagination,
			DocumentoActionsComponent,
			Form, Field, ErrorMessage,
		},

		setup() {
			const query = ref();
			const filterText = ref('');
			const documentos = ref({ data: []});
			const filter = computed(() => documentos.value.data.filter((documento) => `${documento.correlativo} ${documento.asunto}`.toLowerCase().includes(filterText.value.toLowerCase())));
			const sinResultados = ref(false);
			
			const search = (url) => {
				sinResultados.value = false;
				const apiUrl = url ? url : '/api/documentos';

				axios.get(apiUrl, {
					params: {
						q: query.value
					}
				})
				.then(response => {
					documentos.value = response.data
					if(documentos.value.data.length == 0) {
						sinResultados.value = true;
					}
				})
			};
			return {
				query,
				filterText,
				documentos,
				sinResultados,
				filter,
				search,
				formatDateWithHour,
			}
		}
	}
</script>
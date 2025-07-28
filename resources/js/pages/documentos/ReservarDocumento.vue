<template>
	<div class="row">
		<div class="col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2">
			<div class="card shadow-lg p-3 mb-5 bg-body-tertiary rounded">
				<div class="card-body">
					<div class="mb-3">
						<label class="form-label" for="tipo_documento_id">
							Seleccione el tipo de documento a reservar
						</label>
						<v-select name="tipo_documento_id" id="tipo_documento_id" :options="tipoDocumentos" :reduce="td => td.id" label="name" v-model="documento.tipo_documento_id" @option:selected="obtenerUltimoCorrelativo"/>
					</div>
					<div v-show="documento.tipo_documento_id">
						<p>{{ultimoCorrelativo}}</p>
						<div class="btn-group">
							<button class="btn btn-outline-primary" v-on:click="reservaSimple">
								<i class="bi bi-lightning text-warning"></i>
								Reserva básica
							</button>
							<router-link class="btn btn-outline-primary" title="Reserva completa. Con esta opción usted podrá reservar un documento y generar el pdf" :to="{ name: 'CrearDocumento', query: { 'type': documento.tipo_documento_id } }">
								<i class="bi bi-card-list"></i>
								Reserva completa
							</router-link>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import Swal from 'sweetalert2';
import '@sweetalert2/theme-bootstrap-4/bootstrap-4.min.css';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
import copy from 'copy-to-clipboard';
import useToast from 'vue-toastification';

export default {
	name: 'ReservarDocumento',
	components: {
		'v-select': vSelect,
	},
	data() {
		return {
			toast: useToast,
			documento: {},
			tipoDocumentos: [],
			ultimoCorrelativo: '',
		}
	},
	mounted() {
		this.obtenerDocumentos();
	},
	methods: {
		copyToClipboard(value) {
			navigator.clipboard.writeText(value);
		},
		obtenerDocumentos() {
			axios.get('/api/tipo-documentos?format=vue-select').then(response => {
				this.tipoDocumentos = response.data;
				localStorage.setItem('td', JSON.stringify(response.data));
			});
		},

		obtenerUltimoCorrelativo() {
			const id = this.documento.tipo_documento_id;
			axios.get('/api/tipo-documentos/' + id).then(response => {
				const now = new Date().toLocaleString();
				this.ultimoCorrelativo = `Siguiente correlativo: ${response.data.full_correlativo} (${now})`;
			});
			
		},
		reservaSimple() {
			const tipoDocumento = this.tipoDocumentos.find(td => td.id == this.documento.tipo_documento_id);
			Swal.fire({
				title: 'Reserva básica de: ' + tipoDocumento.name,
				text: this.ultimoCorrelativo,
				icon: 'info',
				input: 'textarea',
				inputLabel: 'Asunto',
				inputAttributes: {
					autocapitalize: 'off',
					name: 'asunto'
				},
				inputValidator: (asunto) => {
					if (!asunto) {
						return 'El campo asunto es requerido'
					}
				},
				showCancelButton: true,
				confirmButtonText: 'Reservar documento',
				cancelButtonText:'Cancelar',
				showLoaderOnConfirm: true,
				preConfirm: (asunto) => {
					return axios.post(`/api/documentos`, {
						fecha_emision: null,
						asunto: asunto,
						destinatario_id: null,
						respuesta: null,
						referencia: null,
						tipo_documento_id: this.documento.tipo_documento_id
					})
					.then(response => {
						return response
					})
					.catch(error => {
						Swal.showValidationMessage(
							`Error en la petición: ${error.response.data.message}`
							)
					})
				},
				allowOutsideClick: () => !Swal.isLoading()
			}).then((result) => {
				if (result.isConfirmed) {
					Swal.fire({
						customClass: {
							validationMessage: 'my-validation-message',
						},
						icon: 'success',
						title: 'Documento reservado exitosamente',
						html: `
							<table class="table">
								<thead><tr><td class=></td><td></td></tr></thead>
								<tbody>
									<tr>
										<td>
											<span class="float-end">Tipo:</span>
										</td>
										<td>
											<span class="float-start">${ tipoDocumento.name }</span>
										</td>
									</tr>
									<tr>
										<td>
											<span class="float-end">Correlativo:</span>
										</td>
										<td>
											<span class="float-start">
												${ result.value.data.correlativo }
												<i id="btn-copy-correlativo" role="button" class="ms-2 bi bi-copy" title="Copiar correlativo"></i>
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						`,
						didOpen: () => {
							const btnCopy = document.getElementById('btn-copy-correlativo');
							if (btnCopy) {
								btnCopy.addEventListener('click', () => {
									copy(result.value.data.correlativo);
									Swal.showValidationMessage('<i class="bi bi-clipboard-check"></i> Correlativo copiado al portapapeles');
								});
							}
						}
					})
					.finally(result => {
						this.documento.tipo_documento_id = undefined;
					})
				}
			})
		}
	}
}
</script>

<style>
.my-validation-message::before {
  display: none;
}

.my-validation-message i {
  margin: 0 0.4em;
  color: var(--bs-green);
  font-size: 1.4em;
}
</style>

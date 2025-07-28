<template>
	<div class="row">
		<div class="col-sm-12 col-xl-6">
			<h5>Cargar pdf</h5>
			<div class="card mb-3 h-75">
				<div class="card-body box-profile">
					<div class="alert alert-success alert-dismissible fade show" role="alert" v-if="isUpload">
						El archivo <span class="badge text-bg-light"><i class="bi bi-file-pdf text-danger"></i> {{ pdf.name }}</span> fue cargado correctamente.
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
					<form id="form" v-on:submit.prevent="submit">
						<div class="mb-3">
							<Field name="pdf" label="pdf" rules="required|mimes:application/pdf|size:10000" v-slot="{ handleChange, handleBlur, field }">
								<input type="file" @change="handleChange" @blur="handleBlur"/>
							</Field>
							<br>
							<ErrorMessage name="pdf"></ErrorMessage>
						</div>
						<button class="btn btn-primary mb-3" type="submit">
							<i class="fas fa-upload fa-lg"></i>
							Subir pdf
						</button>
					</form>
				</div>
			</div>
		</div>
		<div class="col-sm-12 col-xl-6">
			<h5>Detalles</h5>
			<documento-details-component :documento="documento" />
		</div>
		<div class="col-sm-12">
			<h3 v-if="pdf.file_url && !isUpload">Vista previa del documento a cargar</h3>
			<h3 v-else-if="documento.file_url">Documento cargado</h3>
			<div class="ratio ratio-4x3" v-if="pdf.file_url || documento.file_url">
				<iframe v-bind:src="pdf.file_url ? pdf.file_url : documento.file_url" allowfullscreen></iframe>
			</div>
		</div>
	</div>
</template>
<script>
import { onMounted, ref, watch } from 'vue';
import { useRoute } from 'vue-router';
import { defineRule, useForm, Field, ErrorMessage } from 'vee-validate';
import { mimes, size } from '@vee-validate/rules';
import DocumentoDetailsComponent from '@/components/DocumentoDetailsComponent.vue';

export default {
	name: 'SubirDocumento',
	components: {
		Field, ErrorMessage,
		DocumentoDetailsComponent,
	},
	setup() {
		const route = useRoute();
		const documento = ref({ archivos: []});
		const pdf = ref({});
		const {values: uploadForm, setFieldError, handleSubmit, resetForm } = useForm();
		const isUpload = ref(false);

		watch([uploadForm], () => {
			if(typeof uploadForm.pdf != 'undefined') {
				pdf.value = uploadForm.pdf;
				pdf.value.file_url = URL.createObjectURL(uploadForm.pdf);

			}
		});

		const submit = handleSubmit(() => {
			axios.post(`/api/documentos/${documento.value.id}/upload`, uploadForm, {
				headers: { 'Content-Type': 'multipart/form-data'}
			}).then(response => {
				isUpload.value = true;
				documento.value.file_url= response.data.file_url
				resetForm();
			}).catch(error => {
				const errors = error.response.data.errors;
				if (errors) {
					Object.entries(errors).forEach(([key, value]) => {
					setFieldError(key, value);
					});
				}
			});
		});

		onMounted(() => {
			defineRule('mimes', mimes);
			defineRule('size', size);
			axios.get(`/api/documentos/${route.params.id}`).then(
				response => {
					documento.value = response.data;
				}
			);
		});

		return {
			documento,
			pdf,
			uploadForm,
			isUpload,
			submit,
		}
	},
}
</script>
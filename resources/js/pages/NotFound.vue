<template>
	<div class="d-flex align-items-center justify-content-center mt-5">
        <div class="text-center">
            <h1 class="display-1 fw-bold">404</h1>
            <p class="fs-3">Página no encontrada.</p>
            <p class="lead">
                La página <b>{{ fullPath }}</b> no existe.
            </p>
            <router-link to="/home" class="btn btn-primary">Ir a inicio</router-link>
        </div>
    </div>
</template>

<script>
import { useRoute } from 'vue-router';

export default {
	name: 'NotFound',
	setup() {
		const route = useRoute();
		
		const fullPath = route.fullPath;
		return {
			fullPath
		}
	}
}

</script>
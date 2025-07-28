<template>
    <div class="row">
        <div class="col-12">
            <ul class="nav nav-underline mb-2">
                <li class="nav-item">
                    <router-link exactActiveClass="active" class="nav-link" :to="{ name: 'ShowDocument', params: { id: $route.params.id}}">Detalles</router-link>
                </li>
                <li class="nav-item">
                    <router-link exactActiveClass="active" class="nav-link" :to="{ name: 'FilesDocument', params: { id: $route.params.id}}">Archivos</router-link>
                </li>
            </ul>
        </div>
        <div class="col-12">
            <router-view/>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ViewDocument',
}
</script>
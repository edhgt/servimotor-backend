<template>
    <div>
        <form class="input-group mb-3 float-end" @submit.prevent="emitParams">
            <label class="me-2" for="columnasSelect">Búsqueda avanzada</label>
            <select v-model="column" class="form-select form-select-sm" required
                id="columnasSelect">
                <option :value="columna.key" v-for="columna in columnas" :key="columna.key">
                    {{ columna.label }}
                </option>
            </select>
            <input class="form-control form-control-sm" v-model="q" type="search" required>
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i>
            </button>
            <button v-if="q != null" class="btn-close" type="button" title="Cancelar búsqueda"
                data-close="true" @click="emitParams">
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref, watch } from "vue";

const props = defineProps(['columnas']);
const emit = defineEmits(['setData'])
const per_page = ref(5)
const column = ref(null)
const q = ref(null)

const emitParams = function (event) {
    if (event?.target.dataset.close) {
        q.value = null
    }
    emit('setData', `column=${column.value}&q=${q.value}`);
}

watch(per_page, () => {
    emitParams()
})
</script>

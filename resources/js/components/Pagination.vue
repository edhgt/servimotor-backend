<template>
    <div class="d-flex justify-content-between mt-2">
        <span class="text-muted">Mostrando de {{ from }} a {{ to }} elementos</span>
        <nav aria-label="Paginación" v-if="prev || next">
        <ul class="pagination justify-content-end">
            <li class="page-item" :class="{'disabled': !prev}">
            <button class="page-link" @click="handlePageChange(prev)">Anterior</button>
            </li>
            <li class="page-item" :class="{'disabled': !next}">
            <button class="page-link" @click="handlePageChange(next)">Siguiente</button>
            </li>
        </ul>
        </nav>
    </div>
</template>

<script>
import { makeUrlWithPaginate } from "@/utils/pagination";

export default {
  name: "Pagination",
  props: {
    from: { type: [Number, String, null], required:false, default: null },
    to: { type: [Number, String, null], required:false, default: null },
    perPage: { type: [Number, String, null], required:false, default: null },
    prev: { type: [String, null], required:false, default: null },
    next: { type: [String, null], required:false, default: null },
  },
  emits: ['change-page'],
  setup(props, context) {

    const handlePageChange = (url) => {
      context.emit('change-page', makeUrlWithPaginate(url, props.perPage));
    };

    return {
      handlePageChange,
    };
  },
};
</script>
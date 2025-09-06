<template>
  <div class="card">
    <div class="card-header" v-if="searchable || paginable">
      <div class="card-tools">
        <select v-model="laravelResponse.per_page" class="form-select" @change="handlePerPageChange">
          <option v-for="size in [5, 10, 15, 20, 50, 100, 150, 200, 500, 1000]" :key="size" :value="size">
            {{ size }} por página
          </option>
        </select>
      </div>
      <div class="input-group w-50" v-if="searchable">
        <input type="search" v-model="searchQuery" placeholder="Buscar..." class="form-control" />
      </div>
    </div>
    <div class="card-body p-0 table-responsive">
      <table class="table table-hover table-striped table-bordered">
        <thead>
          <tr>
            <th scope="col" :class="column.thClass" :style="column.thStyle" v-for="column in columns" :key="column.key">
              {{ column.label }}
            </th>
            <th v-if="$slots.actionTitle"><slot name="actionTitle"></slot></th>
            <th v-else-if="containOptions">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <template v-for="(item, index) in itemsFiltered" :key="item.id">
            <tr>
              <td v-for="column in columns" :key="column.key">
                <slot :name="column.key" :value="item[column.key]" :item="item">
                  <template v-if="column.key.includes('_at')">{{formatDate(item[column.key])}}</template>
                  <template v-else-if="typeof item[column.key] === 'object'">{{ item[column.key]?.name }}</template>
                  <template v-else>{{ item[column.key] }}</template>
                </slot>
              </td>
              <td v-if="$slots.actions && containOptions">
                <slot name="actions" :item="item" :index="index"></slot>
              </td>
            </tr>
          </template>
          <tr v-if="!itemsFiltered.length">
            <td :colspan="columns.length + (columns.length ? 1 : 0)" class="text-center">
              <slot name="emptyText" :item="item" :index="index" v-if="$slots.emptyText"></slot>
              <span v-else>No se encontraron datos.</span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <Pagination
    :from="laravelResponse.meta.from"
    :to="laravelResponse.meta.to"
    :per-page="laravelResponse.meta.per_page"
    :prev="laravelResponse.links.prev"
    :next="laravelResponse.links.next"
    @change-page="handlePageChange"
  ></Pagination>
</template>

<script lang="ts">
import { ref, computed, toRef, ThHTMLAttributes } from "vue";
import { formatDate } from "../utils/dateUtils";
import Pagination from "@/components/Pagination.vue";

export default {
  name: "SimplePaginatedTable",
  components: {
    Pagination
  },
  props: {
    laravelResponse: { type: Object, required: true, default: { data: [], meta: { per_page: 5, from: null, to: null}, links: { prev: null, next: null}}},
    columns: { type: Array as () => { key: string; label: string, thClass: string, thStyle: ThHTMLAttributes }[], required: true },
    searchable: { type: Boolean, default: true },
    paginable: { type: Boolean, default: true },
    containOptions: { type: Boolean, default: true },
  },
  emits: ['change-page'],
  setup(props, context) {
    const laravelResponse = toRef(props, 'laravelResponse');
    const searchQuery = ref("");
    const containOptions = toRef(props, 'containOptions');

    const itemsFiltered = computed(() => {
      if (!searchQuery.value) {
        return laravelResponse.value.data;
      }

    const query = searchQuery.value.toLowerCase();
      return laravelResponse.value.data.filter((item) =>
      props.columns.some((column) => {
        const value = item[column.key];
        if (value == null) return false;
        return value.toString().toLowerCase().includes(query);
      }));
    });

    console.log(props.laravelResponse)

    const handlePageChange = (url: string) => {
      context.emit('change-page', `${url}&per_page=${laravelResponse.value.per_page}`);
    };

    const handlePerPageChange = () => {
      const url = `${laravelResponse.value.path}?page=${laravelResponse.value.current_page}&per_page=${laravelResponse.value.per_page}`
      context.emit('change-page', url);
    };

    return {
      laravelResponse,
      itemsFiltered,
      searchQuery,
      containOptions,
      handlePageChange,
      handlePerPageChange,
      formatDate
    };
  },
};
</script>

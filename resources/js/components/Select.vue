<template>
  <v-select
    :options="options"
    :label="label"
    :reduce="reduceFunction"
    :placeholder="placeholder"
    v-model="innerValue"
    @open="handleFocus"
    @option:created="createOption"
    @close="setUndefined"
    v-if="!multiple"
  >
    <template #selected-option="slotProps">
      <slot name="selected-option" v-bind="slotProps" />
    </template>
    <template #no-options="{ search }">
      <template v-if="search == ''">No hay opciones disponibles</template>
      <template v-else>
        Lo sentimos, ninguna opción coincide con el valor ingresado
        <button type="button" class="btn btn-outline-primary btn-sm" @click="fetchOptions" v-if="!updable">Actualizar
          lista</button>
        <button type="button" class="btn btn-outline-primary btn-sm" @click="createOption(search)" v-if="createable">Registrar opción</button>
      </template>
    </template>
    <template #list-footer v-if="updable">
      <div class="px-3 mt-2 d-flex justify-content-start">
        <a href="#" type="button" class="text-decoration-none fs-6 text-secondary" style="--bs-text-opacity: .5;"
          @click="fetchOptions">
          <i class="bi bi-arrow-repeat"></i>
          Actualizar lista
        </a>
      </div>
    </template>
  </v-select>
  <v-select
    :options="options"
    :label="label"
    :reduce="reduceFunction"
    :placeholder="placeholder"
    v-model="innerValue"
    @open="handleFocus"
    @option:created="createOption"
    @close="setUndefined"
    multiple
    v-else
  >
    <template #no-options="{ search }">
      <template v-if="search == ''">No hay opciones disponibles</template>
      <template v-else>
        Lo sentimos, ninguna opción coincide con el valor ingresado
        <button type="button" class="btn btn-outline-primary btn-sm" @click="fetchOptions" v-if="!updable">Actualizar
          lista</button>
        <button type="button" class="btn btn-outline-primary btn-sm" @click="createOption(search)" v-if="createable">Registrar opción</button>
      </template>
    </template>
    <template #list-footer v-if="updable">
      <div class="px-3 mt-2 d-flex justify-content-start">
        <a href="#" type="button" class="text-decoration-none fs-6 text-secondary" style="--bs-text-opacity: .5;"
          @click="fetchOptions">
          <i class="bi bi-arrow-repeat"></i>
          Actualizar lista
        </a>
      </div>
    </template>
  </v-select>
</template>

<script>
import { ref, onMounted, watch, toRef } from 'vue';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

export default {
  name: 'Select',
  components: { vSelect },
  props: {
    url: { type: String, required: true },
    label: { type: String, default: 'nombre' },
    placeholder: { type: String, default: null },
    modelValue: { type: [String, Number, Object, Array], default: undefined },
    parentId: { type: [String, Number], default: undefined },
    resource: { type: String, default: '' },
    lazy: { type: Boolean, default: true },
    updable: { type: Boolean, default: true },
    createable: { type: Boolean, default: false },
    multiple: { type: Boolean, default: false },
  },
  setup(props, { emit }) {
    const options = ref();
    const innerValue = ref(props.modelValue);
    const isOptionsLoaded = ref(false);
    const parentId = toRef(props, 'parentId');
    const lazy = toRef(props, 'lazy');
    const multiple = toRef(props, 'multiple');

    const buildApiUrl = () => {
      return props.resource && parentId.value
        ? `${props.url}/${parentId.value}/${props.resource}`
        : props.url;
    };
    const reduceFunction = option => {
      if(typeof option === undefined) {
        return;
      }

      if(option.hasOwnProperty('id')) {
        return option.id;
      }
      return option;
    };

    const setUndefined = () => {
      if(typeof innerValue.value === 'string') {
        emit('update:modelValue', undefined);
        innerValue.value= null;
      }
    }

    const createOption = (option) => {
      const apiUrl = buildApiUrl();

      axios.post(apiUrl, {[props.label]: option}).then(response => {
        options.value.push(response.data)
        return response.data;
      })
    }

    const fetchOptions = () => {
      if (props.resource && !parentId.value) {
        options.value = [];
        return;
      }

      const apiUrl = buildApiUrl();

      axios.get(apiUrl, {
        params: { per_page: 999, format: 'vue-select' }
      }).then(response => {
        if (response.data.hasOwnProperty('data')) {
          options.value = response.data.data;
        } else {
          options.value = response.data;
        }
        isOptionsLoaded.value = true;
      });
    };

    const handleFocus = () => {
      if (!isOptionsLoaded.value) {
        fetchOptions();
      }
    };

    watch(options, (newOptions, oldOptions) => {
      if (
        innerValue.value &&
        !options.value.some((option) => option.id === innerValue.value)
      ) {
        if(oldOptions) {
          const option = oldOptions.find(option => option?.id == innerValue.value);
          if(option) {
            options.value.push(option);
          }
        }
      }
    });

    const deepEqual = (a, b) => JSON.stringify(a) === JSON.stringify(b);

    watch(
      () => props.modelValue,
      (newValue) => {
        if (!deepEqual(innerValue.value, newValue)) {
          innerValue.value = newValue;
          handleFocus();
        }
      }
    );

    watch(innerValue, (newValue) => {
      if (!deepEqual(newValue, props.modelValue)) {
        emit('update:modelValue', newValue);
      }
    });

    // watch(innerValue, (newValue) => {
    //   if (typeof newValue !== 'undefined') {
    //     emit('update:modelValue', newValue);
    //   }
    // });

    watch(
      () => parentId.value,
      () => {
        if (parentId.value != undefined && typeof parentId.value != 'string') {
          fetchOptions();
        }
      },
      { immediate: true }
    );

    onMounted(() => {
      if (!lazy.value) {
        fetchOptions();
      }
    });

    return {
      options,
      innerValue,
      setUndefined,
      reduceFunction,
      createOption,
      fetchOptions,
      handleFocus,
      multiple,
    }
  }
}

</script>
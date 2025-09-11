<template>
  <div :id="id" ref="modalRef" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" :data-bs-backdrop="backdrop" :data-bs-keyboard="keyboard">
    <div class="modal-dialog" :class="'modal-' + size">
      <div class="modal-content">
        <div class="modal-header">
          <slot class="modal-title" name="header" id="modalLabel" v-if="$slots.header"></slot>
          <h1 class="modal-title fs-4" id="modalLabel" v-else>{{ title }}</h1>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close" v-if="autoClose"></button>
          <slot name="autoClose" v-else></slot>
        </div>
        <div class="modal-body">
          <slot></slot>
        </div>
        <div class="modal-footer" v-if="$slots.footer">
          <slot name="footer"></slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, onBeforeUnmount, ref, watch } from 'vue';
import { Modal } from 'bootstrap';

export default {
  name: 'Modal',
  props: {
    id: { type: String, required: true},
    title: { type: String, required: false, default: 'Modal Title' },
    size: { type: String, default: 'md', validator: value => ['sm', 'md', 'lg', 'xl', 'fullscreen'].includes(value) },
    modelValue: { type: Boolean, default: false },
    autoClose: { type: Boolean, default: true },
    backdrop: { type: [Boolean, String], default: true, validator: (value) => typeof value === 'boolean' || value === 'static',},
    keyboard: { type: [Boolean], default: false}
  },
  setup(props, { emit }) {
    const modalRef = ref(null);
    let modalInstance = null;

    const closeModal = (event) => {
      if (modalInstance) {
        modalInstance.hide();
        emit('update:modelValue', false);
      }
    };

    watch(() => props.modelValue, (newVal) => {
      newVal ? modalInstance.show() : modalInstance.hide();
    });

    onMounted(() => {
      modalInstance = new Modal(modalRef.value);

      if (props.modelValue) {
        modalInstance.show();
      }

      modalRef.value.addEventListener('hidden.bs.modal', closeModal);
    });

    onBeforeUnmount(() => {
      if (modalInstance) {
        modalInstance.dispose();
      }

      modalRef.value.removeEventListener('hidden.bs.modal', closeModal);
    });

    return {
      modalRef,
      closeModal,
    };
  }
};
</script>

<style>
.modal-backdrop {
  z-index: 1040 !important;
  background-color: rgba(0, 0, 0, 0.5) !important;
}

.modal {
  z-index: 1050 !important;
}
</style>
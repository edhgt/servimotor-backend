<template>
  <div :id="id" ref="modalRef" class="modal fade" aria-labelledby="modalLabel">
    <div class="modal-dialog" :class="['modal-' + size, centered? 'modal-dialog-centered' : null, scrollable ? 'modal-dialog-scrollable' : null]">
      <div class="modal-content">
        <div class="modal-header">
          <slot class="modal-title" name="header" id="modalLabel" v-if="$slots.header"></slot>
          <h1 class="modal-title fs-4" id="modalLabel" v-else>{{ title }}</h1>
          <button type="button" class="btn-close" @click="closeModal" aria-label="Close" v-if="autoClose"></button>
          <slot name="autoClose" v-else></slot>
        </div>
        <div class="modal-body" id="modalBody">
          <slot></slot>
        </div>
        <div class="modal-footer d-block" v-if="$slots.footer">
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
    scrollable: { type: Boolean, default: false },
    backdrop: { type: [Boolean, String], default: true, validator: (value) => typeof value === 'boolean' || value === 'static',},
    keyboard: { type: [Boolean], default: true},
    centered: { type: [Boolean], default: false},
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
      modalInstance = new Modal(modalRef.value, {
        backdrop: props.backdrop ? props.backdrop : 'static',
        focus: true,
        keyboard: props.keyboard,
      });

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

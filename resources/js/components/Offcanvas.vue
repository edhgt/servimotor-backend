<template>
  <div ref="offcanvasRef" class="offcanvas offcanvas-end" :data-bs-scroll="scroll" :data-bs-backdrop="backdrop" tabindex="-1" :id="id" :aria-labelledby="ariaLabelledBy" aria-modal="true" role="dialog" :style="{ '--bs-offcanvas-width': size }">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" :id="id + 'Label'">{{ title }}</h5>
      <button type="button" class="btn-close" aria-label="Close" @click="close"></button>
    </div>
    <div class="offcanvas-body">
      <slot><p>Default offcanvas content</p></slot>
    </div>
    <div class="offcanvas-footer" v-if="$slots.footer">
      <slot name="footer"></slot>
    </div>
  </div>
</template>

<script>
import { onMounted, onUnmounted, ref, watch } from 'vue';

export default {
  name: 'Offcanvas',
  props: {
    id: { type: String, required: true, },
    ariaLabelledBy: { type: String, default: 'offcanvas', },
    title: { type: String, required: true },
    show: { type: Boolean, default: () => false, },
    backdrop: { type: String, default: () => 'false', },
    scroll: { type: Boolean, default: () => true, },
    size: { type: String, default: '400px', },
  },
  emits: ['close'],
  setup(props, { emit }) {
    const offcanvasRef = ref(null);
    const offcanvasInstance = ref(null);

    const close = () => {
      if (offcanvasInstance.value) {
        offcanvasInstance.value.hide();
        emit('close');
      }
    };

    onMounted(() => {
      offcanvasInstance.value = new bootstrap.Offcanvas(offcanvasRef.value);
      if (props.show) {
        offcanvasInstance.value.show();
      }
    });

    onUnmounted(() => {
      if (offcanvasInstance.value) {
        offcanvasInstance.value.dispose();
        offcanvasInstance.value = null;
      }
    });

    watch(
      () => props.show,
      (newShow) => {
        if (newShow) {
          offcanvasInstance.value.show();
        } else {
          offcanvasInstance.value.hide();
        }
      }
    );

    return {
      offcanvasRef,
      close,
    };
  },
};
</script>

<style>
.offcanvas.offcanvas-end {
  width: var(--bs-offcanvas-width);
}
</style>

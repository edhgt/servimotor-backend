import { useUserStore } from '@/store/user';
import { watch } from 'vue';

export default {
  mounted(el, binding) {
    const auth = useUserStore();

    const checkPermission = () => {
      const perms = Array.isArray(binding.value) ? binding.value : [binding.value];
      if (!auth.hasAnyPermission(perms)) {
        el.remove();
      }
    };

    checkPermission();

    watch(() => auth.user.permissions, checkPermission, { deep: true });
  }
};

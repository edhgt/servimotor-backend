import { useUserStore } from '@/store/user';

export default {
  mounted(el, binding) {
    const auth = useUserStore();
    if (!auth.hasPermission(binding.value)) {
        el.remove();
    }
  }
};

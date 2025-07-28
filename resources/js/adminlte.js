import { createApp } from 'vue';
import { createPinia } from 'pinia';
import Toast from "vue-toastification";
import { configure, defineRule } from 'vee-validate';
import { required, max } from '@vee-validate/rules';
import { localize, setLocale } from '@vee-validate/i18n';
import es from '@vee-validate/i18n/dist/locale/es.json';

import './bootstrap';
import router from './router';
import ContentHeader from './components/layout/ContentHeader.vue';
import UserMenu from './components/layout/UserMenu.vue';
import Sidebar from './components/layout/Sidebar.vue';

const pinia = createPinia();

const app = createApp({
    components: { ContentHeader, UserMenu, Sidebar },
    mounted() {
        defineRule('required', required);
        defineRule('max', max);
        configure({
            generateMessage: localize({ es }),
        });
        setLocale('es');
        import('admin-lte/dist/js/adminlte.min.js').then(() => {
            import('./utils/initOverlayScrollbars').then(mod => mod.initSidebarScrollbar());
        });
    }
});

app.use(router);
app.use(pinia);
app.use(Toast);

app.mount('#app');

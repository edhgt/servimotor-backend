import { createApp } from 'vue';
import { createPinia } from 'pinia';
import Toast from "vue-toastification";

import './bootstrap';

import router from './router';
import ContentHeader from './components/layout/ContentHeader.vue';
import UserMenu from './components/layout/UserMenu.vue';
import Sidebar from './components/layout/Sidebar.vue';

import canDirective from './directives/can';

const pinia = createPinia();

const app = createApp({
    components: { ContentHeader, UserMenu, Sidebar },
    mounted() {
        import('admin-lte/dist/js/adminlte.min.js').then(() => {
            import('./utils/initOverlayScrollbars').then(mod => mod.initSidebarScrollbar());
        });
    }
});

app.use(router);
app.use(pinia);
app.use(Toast);
app.directive('can', canDirective);

app.mount('#app');

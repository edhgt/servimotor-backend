import axios from 'axios';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import { useToast } from 'vue-toastification';

const toast = useToast();
let isSessionExpired = false;

// Configuración opcional de NProgress
NProgress.configure({ showSpinner: false }); // Opcional: oculta el spinner

// Interceptor de solicitud
axios.interceptors.request.use(config => {
    NProgress.start();
    return config;
}, error => {
    NProgress.done(true);
    return Promise.reject(error);
});

// Interceptor de respuesta
axios.interceptors.response.use(
    response => {
        NProgress.done(true);
        return response;
    },
    error => {
        NProgress.done(true);

        let message = error?.response?.data?.message ?? 'Error inesperado';
        
        if (error.response && (error.response.status === 401 || error.response.status === 419)) {
            if (!isSessionExpired) {
                isSessionExpired = true;
                toast.error('Su sesión ha expirado.', {
                    position: 'top-center',
                    timeout: 20000,
                    onClose: () => window.location.href = '/login'
                });
            }
        }
        
        else if (error.response?.status === 403) {
            message = 'Esta acción no está autorizada.';
        }

        else {
            toast.error(message, { position: 'top-center' });
        }

        return Promise.reject(error);
    }
);

export default axios;

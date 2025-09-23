import axios from 'axios';
import '@bprogress/core/css';
import { BProgress } from '@bprogress/core';
import { useToast } from 'vue-toastification';

const toast = useToast();
let isSessionExpired = false;

// Configuración opcional de BProgress
BProgress.configure({ showSpinner: false }); // Opcional: oculta el spinner

// Interceptor de solicitud
axios.interceptors.request.use(config => {
    BProgress.start();
    return config;
}, error => {
    BProgress.done(true);
    return Promise.reject(error);
});

// Interceptor de respuesta
axios.interceptors.response.use(
    response => {
        BProgress.done(true);
        return response;
    },
    error => {
        BProgress.done(true);

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

import { createRouter, createWebHistory } from 'vue-router';

import commonsRoutes from './modules/commons.routes';
import destinatarioRoutes from './modules/destinatario.routes';
import documentsRoutes from './modules/documents.routes';

const routes = [
	...commonsRoutes,
  ...destinatarioRoutes,
  ...documentsRoutes,
	{
		path: '/:pathMatch(.*)*',
		component: () => import('@/pages/NotFound.vue'),
		meta: { title: null }
	}
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  linkActiveClass: 'active-bg',
  linkExactActiveClass: 'exact-active',
});


function setDocumentTitle(title) {
  const appName = import.meta.env.VITE_APP_NAME;
  document.title = title ? `${title} | ${appName}` : appName;
}

router.beforeEach((to, from, next) => {
  setDocumentTitle(to.meta.title);
  next();
});

// router.beforeEach((to, from, next) => {
	
// 	if (to.name != 'home' && !store.state.user.permissions.some(function(permission) { return permission.name == to.meta.permission })) {
// 		Toast.fire({
// 			icon: 'warning',
// 			title: 'Acceso no autorizado',
// 			text: `No tiene permisos para acceder: ${to.meta.title}`
// 		});
// 		//next({ name: 'reservar.index'});
// 		return;
// 	} else {
// 		document.title = to.meta.title || 'Documentos';
// 		next();
// 	}
	
// });

/**
 * Carga rutas dinámicas en función de los roles del usuario
 * @param {string[]} roles - Ej. ['admin', 'editor']
 */
export async function loadRoleRoutes(routeModules = []) {
  for (const routeModule of routeModules) {
    try {
      const module = await import(/* @vite-ignore */`./modules/${routeModule}`)
      const routeRoutes = module.default

      routeRoutes.forEach(route => {
        if (!router.hasRoute(route.name)) {
          router.addRoute(route)
        }
      })
    } catch (error) {
      console.warn(`Error cargando rutas del rol "${route}":`, error)
    }
  }
}

export default router;

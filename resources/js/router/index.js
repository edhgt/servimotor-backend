import { createRouter, createWebHistory } from 'vue-router';

import commonsRoutes from './modules/commons.routes';
import adminRoutes from './modules/admin.routes';
import catalogosRoutes from './modules/catalogos.routes';
import clientesRoutes from './modules/clientes.routes';

const routes = [
	...commonsRoutes,
  ...adminRoutes,
  ...catalogosRoutes,
  ...clientesRoutes,
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

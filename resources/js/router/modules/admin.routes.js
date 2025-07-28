export default [
    {
        path: '/users',
        name: 'UsersIndex',
        component: () => import('@/pages/admin/Users.vue'),
        meta: { title: 'Usuarios', permission: 'Usuarios'}
    },
    {
        path: '/correlativos',
        name: 'Correlativos',
        component: () => import('@/pages/Correlativos.vue'),
        meta: { title: 'Correlativos', permission: 'Correlativos'}
    },
    {
        path: '/plantillas',
        name: 'Plantillas',
        component: () => import('@/pages/Plantillas.vue'),
        meta: { title: 'Plantillas', permission: 'Plantillas'}
    },
    {
        path: '/bitacora',
        name: 'bitacora.index',
        component: () => import('@/pages/Bitacora.vue'),
        meta: { title: 'Bitácora', permission: 'Bitácora'}
    },
    {
        path: '/reportes',
        name: 'Reportes',
        component: () => import('@/pages/Reportes.vue'),
        meta: { title: null, permission: 'Reportes'}
    },
    {
        path: '/permisos',
        name: 'Permissions',
        component: () => import('@/pages/admin/Permisos.vue'),
        meta: { title: 'Permisos', permission: 'Permisos' }
    },	
    {
        path: '/roles',
        name: 'Roles',
        component: () => import('@/pages/Roles.vue'),
        meta: { title: 'Roles', permission: 'Roles' }
    },
];
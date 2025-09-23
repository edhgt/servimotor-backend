export default [
    {
        path: '/users',
        name: 'users',
        component: () => import('@/pages/admin/Users.vue'),
        meta: { title: 'Usuarios', permission: 'Usuarios'}
    },
    {
        path: '/permisos',
        name: 'permissions',
        component: () => import('@/pages/admin/Permisos.vue'),
        meta: { title: 'Permisos', permission: 'Permisos' }
    },	
    {
        path: '/roles',
        name: 'roles',
        component: () => import('@/pages/admin/Roles.vue'),
        meta: { title: 'Roles', permission: 'Roles' }
    },
    {
        path: '/bitacora',
        name: 'bitacora',
        component: () => import('@/pages/admin/Bitacora.vue'),
        meta: { title: 'Bitácora', permission: 'Bitácora'}
    },
];
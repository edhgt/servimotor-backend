export default [
    {
        path: '/users',
        name: 'Users',
        component: () => import('@/pages/admin/Users.vue'),
        meta: { title: 'Usuarios', permission: 'Usuarios'}
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
        component: () => import('@/pages/admin/Roles.vue'),
        meta: { title: 'Roles', permission: 'Roles' }
    },
];
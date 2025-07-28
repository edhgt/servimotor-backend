export default [
    {
		path: '/saludos',
		name: 'saludos',
		component: () => import('@/pages/admin/Saludos.vue'),
		meta: { title: 'Saludos', permission: 'Saludos'}
	},
	{
		path: '/dependencias',
		name: 'dependencias',
		component: () => import('@/pages/admin/Dependencias.vue'),
		meta: { title: 'Dependencias', permission: 'Dependencias'}
	},
	{
		path: '/entidades',
		name: 'entidades',
		component: () => import('@/pages/admin/Entidades.vue'),
		meta: { title: 'Entidades', permission: 'Entidades'}
	},
	{
		path: '/cargos',
		name: 'cargos',
		component: () => import('@/pages/admin/Cargos.vue'),
		meta: { title: 'Cargos', permission: 'Cargos'}
	},
	{
		path: '/destinatarios',
		name: 'destinatarios',
		component: () => import('@/pages/Destinatarios.vue'),
		meta: { title: 'Destinatarios', permission: 'Destinatarios'}
	},
];
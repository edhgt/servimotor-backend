export default [
    {
		path: '/clientes',
		name: 'clientes',
		component: () => import('@/pages/clientes/Clientes.vue'),
		meta: { title: 'Clientes', permission: 'clientes'}
	},
];
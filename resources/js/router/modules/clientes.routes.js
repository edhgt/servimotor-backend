export default [
    {
		path: '/clientes',
		name: 'clientes',
		component: () => import('@/pages/clientes/Clientes.vue'),
		meta: { title: 'Clientes', permission: 'clientes'}
	},
	{
		path: '/clientes/:id',
		name: 'clientes.show',
		component: () => import('@/pages/clientes/Cliente.vue'),
		meta: { title: 'Cliente', permission: 'clientes.show'},
		children: [
			{
				path: 'vehiculos',
				name: 'clientes.vehiculos',
				component: () => import('@/pages/clientes/ClienteVehiculos.vue'),
				meta: { title: 'Cliente', permission: 'clientes.vehiculos'}
			},
		],
	},
];
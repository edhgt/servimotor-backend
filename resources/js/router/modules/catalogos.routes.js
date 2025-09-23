import Home from '@/pages/Home.vue';

export default [
    {
		path: '/categorias',
		name: 'Categorias',
		component: () => import('@/pages/catalogos/Categorias.vue'),
		meta: { title: 'Categorias', permission: 'Categorias'}
	},
    {
		path: '/colores',
		name: 'Colores',
		component: () => import('@/pages/catalogos/Colores.vue'),
		meta: { title: 'Colores', permission: 'Colores'}
	},
    {
		path: '/marcas',
		name: 'Marcas',
		component: () => import('@/pages/catalogos/Marcas.vue'),
		meta: { title: 'Marcas', permission: 'Marcas'}
	},
    {
		path: '/modelos',
		name: 'Modelos',
		component: () => import('@/pages/catalogos/Modelos.vue'),
		meta: { title: 'Modelos', permission: 'Modelos'}
	},
];
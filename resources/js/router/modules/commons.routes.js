import Home from '@/pages/Home.vue';

export default [
    {
		path: '/home',
		name: 'home',
		component: Home,
		meta: { title: 'Página de inicio', permission: 'Inicio'}
	},
    {
		path: '/user/profile',
		name: 'user.profile',
		component: () => import('@/pages/Profile.vue'),
		meta: { title: 'Perfil de usuario', permission: 'Profile'}
	},
];
export default [
    {
		path: '/categorias',
		name: 'categorias',
		component: () => import('@/pages/catalogos/Categorias.vue'),
		meta: { title: 'Categorias', permission: 'categorias'}
	},
    {
		path: '/colores',
		name: 'colores',
		component: () => import('@/pages/catalogos/Colores.vue'),
		meta: { title: 'Colores', permission: 'colores'}
	},
    {
		path: '/marcas',
		name: 'marcas',
		component: () => import('@/pages/catalogos/Marcas.vue'),
		meta: { title: 'Marcas', permission: 'marcas'}
	},
    {
		path: '/modelos',
		name: 'modelos',
		component: () => import('@/pages/catalogos/Modelos.vue'),
		meta: { title: 'Modelos', permission: 'modelos'}
	},
	{
		path: '/estados',
		name: 'estados',
		component: () => import('@/pages/catalogos/Estados.vue'),
		meta: { title: 'Estados', permission: 'estados'}
	},
	{
		path: '/tipos-vehiculo',
		name: 'tipos-vehiculo',
		component: () => import('@/pages/catalogos/TiposVehiculo.vue'),
		meta: { title: 'Tipos de vehículo', permission: 'tipos-vehiculo'}
	},
	{
		path: '/tipos-motor',
		name: 'tipos-motor',
		component: () => import('@/pages/catalogos/TiposMotor.vue'),
		meta: { title: 'Tipos de motor', permission: 'tipos-motor'}
	},
	{
		path: '/tipos-transmision',
		name: 'tipos-transmision',
		component: () => import('@/pages/catalogos/TiposTransmision.vue'),
		meta: { title: 'Tipos de transmisión', permission: 'tipos-transmision'}
	},
	{
		path: '/unidades-medida',
		name: 'unidades-medida',
		component: () => import('@/pages/catalogos/UnidadesMedida.vue'),
		meta: { title: 'Unidades de medida', permission: 'unidades-medida'}
	},
	{
		path: '/formas-pago',
		name: 'formas-pago',
		component: () => import('@/pages/catalogos/FormasPago.vue'),
		meta: { title: 'Formas de pago', permission: 'formas-pago'}
	},
	{
		path: '/tipos-documento',
		name: 'tipos-documento',
		component: () => import('@/pages/catalogos/TiposDocumento.vue'),
		meta: { title: 'Tipos de documento', permission: 'tipos-documento'}
	},
	{
		path: '/puestos',
		name: 'puestos',
		component: () => import('@/pages/catalogos/Puestos.vue'),
		meta: { title: 'Puestos', permission: 'puestos'}
	},
];
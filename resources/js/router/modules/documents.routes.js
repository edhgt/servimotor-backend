export default [
    {
		path: '/reservar',
		name: 'ReservarDocumento',
		component: () => import('@/pages/documentos/ReservarDocumento.vue'),
		meta: { title: 'Reservar documento', permission: 'Reservar'}
	},
    {
		path: '/reserva',
		name: 'CrearDocumento',
		component: () => import('@/pages/documentos/CrearDocumento.vue'),
		meta: { title: 'Reservar documento', permission: 'Reservar'}
	},
    {
		path: '/search',
		name: 'BuscarDocumento',
		component: () => import('@/pages/documentos/BuscarDocumento.vue'),
		meta: { permission: 'Búsqueda'}
	},
    {
		path: '/mis-documentos',
		name: 'MisDocumentos',
		component: () => import('@/pages/documentos/MisDocumentos.vue'),
		meta: { title: 'Mis documentos', permission: 'Mis documentos'}
	},
    {
		path: '/documentos-pendientes',
		name: 'DocumentosPendientes',
		component: () => import('@/pages/documentos/DocumentosPendientes.vue'),
		meta: { title: 'Documentos pendientes', permission: 'Pendientes'}
	},
    {
        path: '/documentos',
		name: 'Documentos',
		component: () => import('@/pages/documentos/Documentos.vue'),
		meta: { title: 'Documentos', permission: 'Documentos'}
	},
	{
		path: '/documentos',
		name: 'ViewDocument',
		meta: { title: 'Ver documento', permission: 'Documentos.mostrar'},
		component: () => import('@/pages/documentos/ViewDocument.vue'),
		children: [
			{
				path: ':id',
				name: 'ShowDocument',
				component: () => import('@/pages/documentos/ShowDocument.vue'),
			},
			{
				path: ':id/archivos',
				name: 'FilesDocument',
				component: () => import('@/pages/documentos/FilesDocument.vue'),
			},
		]
	},
	{
		path: '/documentos/:id/upload',
		name: 'SubirDocumento',
		component: () => import('@/pages/documentos/SubirDocumento.vue'),
		meta: { title: 'Adjuntar documento'}
	},
	{
		path: '/documentos/:id/edit',
		name: 'ModificarDocumento',
		component: () => import('@/pages/documentos/CrearDocumento.vue'),
		meta: { title: 'Modificar documento', permission: 'Documentos.modificar'}
	},
];
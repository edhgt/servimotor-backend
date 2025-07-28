<template>
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <template v-for="(menuItem, index) in menu" :key="menuItem.label + index">
                    <li class="nav-item" v-if="!menuItem.children">
                        <router-link class="nav-link" :to="menuItem.route">
                            <i class="nav-icon bi" :class="[menuItem.icon]"></i>
                            <p>{{ menuItem.label }}</p>
                        </router-link>
                    </li>
                    <li class="nav-item" v-else>
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi" :class="[menuItem.icon]"></i>
                            <p>
                                {{ menuItem.label }}
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item" v-for="(submenu, subIndex) in menuItem.children" :key="submenu.label + subIndex">
                                <router-link class="nav-link" :to="submenu.route">
                                    <i class="nav-icon bi" :class="[submenu.icon]"></i>
                                    <p>{{ submenu.label }}</p>
                                </router-link>
                            </li>
                        </ul>
                    </li>
                </template>
            </ul>
        </nav>
    </div>
</template>

<script>
import { onMounted, ref } from 'vue';
import { useUserStore } from '@/store/user';
import { loadRoleRoutes } from '@/router';

export default {
    name: 'Sidebar',
    setup() {
        const userStore = useUserStore();
        const menu = ref([]);

        const fullMenu = [
            { permission: null, route: { name: "home" }, icon: "bi-house", label: "Inicio" },
            { permission: "reservar", route: { name: 'ReservarDocumento' }, icon: "bi-hand-index-thumb", label: "Reservar" },
            { permission: "busqueda", route: { name: "BuscarDocumento" }, icon: "bi-search", label: "Búsqueda" },
            { permission: "mis-documentos", route: { name: "MisDocumentos", query: { type: 1 } }, icon: "bi-file-earmark-person", label: "Mis documentos" },
            { permission: "pendientes", route: { name: "DocumentosPendientes", query: { type: 1 } }, icon: "bi-clock", label: "Pendientes" },
            {
                permission: "configuracion", icon: "bi-gear", label: 'Configuración', children: [
                    { permission: "correlativos", route: { name: "Correlativos" }, icon: "bi-123", label: "Correlativos" },
                    { permission: "plantillas", route: { name: "Plantillas" }, icon: "bi-filetype-html", label: "Plantillas" },
                    { permission: "saludos", route: { name: "saludos" }, icon: "bi-person-raised-hand", label: "Saludos" },
                    { permission: "dependencias", route: { name: "dependencias" }, icon: "bi-gear", label: "Dependencias" },
                    { permission: "cargos", route: { name: "cargos" }, icon: "bi-gear", label: "Cargos" },
                    { permission: "entidades", route: { name: "entidades" }, icon: "bi-buildings", label: "Entidades" },
                    { permission: "destinatarios", route: { name: "destinatarios" }, icon: "bi-people", label: "Destinatarios" },
                ]
            },
            {
                permission: "administrador", icon: "bi-files", label: 'Administrador', children: [
                    { permission: "bitacora", route: { name: "bitacora.index" }, icon: "bi-journal-text", label: "Bitácora" },
                    { permission: "documentos", route: { name: "Documentos", query: { type: 1 } }, icon: "bi-files", label: "Documentos" },
                    { permission: "reportes", route: { name: "Reportes" }, icon: "bi-file-bar-graph", label: "Reportes" },
                    { permission: "Permissions", route: { name: "Permissions" }, icon: "bi-lock", label: "Permisos" },
                    { permission: "Roles", route: { name: "Roles" }, icon: "bi-lock", label: "Roles" },
                    { permission: "users", route: { name: "UsersIndex" }, icon: "bi-people", label: "Usuarios" },
                ]
            },
        ];

        const getAvailableMenu = () => {
            const filterMenu = (items) => {
                return items
                    .filter(item => {
                        if (!item.permission) return true;
                        return userStore.user.permissions.some(p => p.name === item.permission);
                    })
                    .map(item => {
                        if (item.children) {
                            return {
                                ...item,
                                children: filterMenu(item.children)
                            };
                        }
                        return item;
                    });
            };

            return userStore.isSuperAdmin()
                ? fullMenu
                : filterMenu(fullMenu);
        };

        const setMenu = () => {
            menu.value = getAvailableMenu();
        };

        const setAdminRoutes = async () => {
            await loadRoleRoutes(['admin.routes.js']);
        };

        onMounted(async () => {
            await userStore.fetchUserProfile();
            if(userStore.isSuperAdmin()) {
                await setAdminRoutes();
            }
            setMenu();
        });

        return {
            menu
        };
    }
};
</script>

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

export default {
    name: 'Sidebar',
    setup() {
        const userStore = useUserStore();
        const menu = ref([]);

        const fullMenu = [
            { permission: "home", route: { name: "home" }, icon: "bi-house", label: "Inicio" },
            { permission: "bitacora", route: { name: "bitacora" }, icon: "bi-journal-text", label: "Bitácora" },
            { permission: "clientes", route: { name: "clientes" }, icon: "bi-people", label: "Clientes" },
            {
                permission: "catalogos", icon: "bi-collection", label: 'Catalogos', children: [
                    { permission: "categorias", route: { name: "categorias" }, icon: "bi-folder", label: "Categorias" },
                    { permission: "colores", route: { name: "colores" }, icon: "bi-palette", label: "Colores" },
                    { permission: "marcas", route: { name: "marcas" }, icon: "bi-r-circle", label: "Marcas" },
                    { permission: "modelos", route: { name: "modelos" }, icon: "bi-car-front", label: "Modelos" },
                    { permission: "estados", route: { name: "estados" }, icon: "bi-arrow-repeat", label: "Estados" },
                    { permission: "puestos", route: { name: "puestos" }, icon: "bi-person-badge", label: "Puestos" },
                    { permission: "tipos-vehiculos", route: { name: "tipos-vehiculo" }, icon: "bi-car-front", label: "Tipos de vehículo" },
                    { permission: "tipos-motor", route: { name: "tipos-motor" }, icon: "bi-gear", label: "Tipos de motor" },
                    { permission: "tipos-transmision", route: { name: "tipos-transmision" }, icon: "bi-gear-wide-connected", label: "Tipos de transmisión" },
                    { permission: "unidades-medida", route: { name: "unidades-medida" }, icon: "bi-rulers", label: "Unidades de medida" },
                    { permission: "formas-pago", route: { name: "formas-pago" }, icon: "bi-credit-card", label: "Formas de pago" },
                    { permission: "tipos-documento", route: { name: "tipos-documento" }, icon: "bi-file-earmark-text", label: "Tipos de documento" },
                    { permission: "servicios", route: { name: "servicios" }, icon: "bi-file-earmark-text", label: "Servicios" },
                ]
            },
            {
                permission: "administrador", icon: "bi-person-gear", label: 'Administrador', children: [
                    { permission: "permissions", route: { name: "permissions" }, icon: "bi-lock", label: "Permisos" },
                    { permission: "roles", route: { name: "roles" }, icon: "bi-lock", label: "Roles" },
                    { permission: "users", route: { name: "users" }, icon: "bi-people", label: "Usuarios" },
                ]
            },
        ];

        const hasPermission = (permission) => {
            if (!permission) return true;
            return userStore.isSuperAdmin() || userStore.hasPermission(permission);
        };

        const filterMenu = (items) => {
            return items
                .filter(item => hasPermission(item.permission))
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

        const setMenu = () => {
            menu.value = filterMenu(fullMenu);
        };

        // const setAdminRoutes = async () => {
        //     await loadRoleRoutes(['admin.routes.js']);
        // };

        onMounted(() => {
            userStore.fetchUserProfile().then(() => {
                setMenu();
            });
        });

        return {
            menu
        };
    }
};
</script>


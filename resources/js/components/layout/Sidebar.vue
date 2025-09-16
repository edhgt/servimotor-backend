<template>
    <div class="sidebar-wrapper" style="color: white;">
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
            { permission: "home", route: { name: "home" }, icon: "bi-house", label: "Inicio" },
            {
                permission: "administrador", icon: "bi-person-gear", label: 'Administrador', children: [
                    { permission: "permissions", route: { name: "Permissions" }, icon: "bi-lock", label: "Permisos" },
                    { permission: "roles", route: { name: "Roles" }, icon: "bi-lock", label: "Roles" },
                    { permission: "users", route: { name: "Users" }, icon: "bi-people", label: "Usuarios" },
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


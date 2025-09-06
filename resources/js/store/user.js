import { ref } from 'vue';
import { defineStore } from 'pinia';
import axios from 'axios';

export const useUserStore = defineStore('user', () => {
  const ADMINISTRADOR_ID = 1;
  const user = ref({
    name: '',
    id: 0,
    persona_id: 0,
    dependencia: { descripcion: '' },
    permissions: new Set(),
    roles: [],
  });
  
  const THEME_KEY = 'adminlte-theme'
  const theme = ref('dark');

  const isSuperAdmin = () => user.value.roles.some(r => Number(r.id) <= ADMINISTRADOR_ID);

  const hasPermission = (permission) => user.value.permissions.has(permission);

  const hasAnyPermission = (permissions) => {
    return permissions.some(p => user.value.permissions.has(p));
  };

  const setUser = (userData) => {
    if (!userData) {
      user.value = {
        name: '',
        id: 0,
        persona_id: 0,
        dependencia: { descripcion: '' },
        permissions: new Set(),
        roles: []
      };
      return;
    }
    user.value = {
      ...userData,
      permissions: new Set(userData.permissions.map(p => p.name))
    };
  };

  const initTheme = () => {
    const savedTheme = localStorage.getItem(THEME_KEY)

    if (savedTheme) {
      theme.value = savedTheme
    } else {
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
      theme.value = prefersDark ? 'dark' : 'light'
    }

    applyTheme()
  };

  const toggleTheme = () => {
    theme.value = theme.value === 'dark' ? 'light' : 'dark'
    applyTheme()
  };

  const applyTheme = () => {
    const body = document.body
    body.setAttribute('data-bs-theme', theme.value);
    localStorage.setItem(THEME_KEY, theme.value)
  };

  const fetchUserProfile = async () => {
    try {
      const { data } = await axios.get('/api/user');
      setUser(data);
    } catch (error) {
      console.error('Error fetching user profile:', error);
    }
  };

  const logout = async () => {
    try {
      await axios.post('/logout');
      setUser(null);
      window.location.href = '/login';
    } catch (error) {
      console.error('Error logging out:', error);
    }
  };

  return {
    user,
    theme,
    isSuperAdmin,
    hasPermission,
    hasAnyPermission,
    setUser,
    initTheme,
    toggleTheme,
    applyTheme,
    fetchUserProfile,
    logout,
  };
});

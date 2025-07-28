import { defineStore } from 'pinia';
import { ref } from 'vue';

export const useUserStore = defineStore('user', () => {
  const ADMINISTRADOR_ID = 1;
  const user = ref({ name: '', id: 0, persona_id: 0, dependencia: { descripcion: ''}, permissions: [], roles: []});

  const isSuperAdmin = () => user.value.roles.some(r => r.id <= ADMINISTRADOR_ID);

  const setUser = (userData) => {
    if(userData) {
      user.value = userData
      user.value.permissions = userData.permissions.map(permission => permission.name);
    }
  };

  const fetchUserProfile = () => {
    return axios.get('/api/user').then(response => {
      setUser(response.data)
    })
  };

  const logout = async() => {
    try {
      await axios.post('/logout')
      setTimeout(() => {
        setUser(null);
        window.location.href = '/login'
      }, 0);
    } catch (error) {
      console.error('Error fetching user profile:', error)
    }
  };

  return {
    user,
    isSuperAdmin,
    setUser,
    fetchUserProfile,
    logout,
  };
});

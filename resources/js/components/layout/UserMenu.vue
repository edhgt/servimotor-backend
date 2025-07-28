<template>
  <li class="nav-item dropdown user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
      <span class="d-none d-md-inline text-truncate me-2">{{userStore.user.name}}</span>
      <img :src="'/images/user.png'" class="user-image rounded-circle shadow" alt="User Image" />
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
      <li class="user-header">
        <img :src="'/images/user.png'" class="rounded-circle shadow" alt="User Image" />
        <p>
          {{userStore?.user.email}} <br>
          {{userStore?.user.description}}
        </p>
      </li>
      <li class="user-body">
        <div class="row">
          <div class="col-12">
            <router-link to="/user/profile">
              <i class="bi bi-person-circle me-2"></i>
              Perfil
            </router-link>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <a href="/guia_tecnica.pdf" target="_blank">
              <i class="bi bi-book me-2"></i>
              Guía técnica
            </a>
          </div>
        </div>
      </li>
      <li class="user-footer text-center">
        <!-- <a href="#" class="btn btn-default btn-flat" role="button">Perfil</a> -->
        <button type="button" role="button" class="btn btn-default btn-flat" @click="logout">Cerrar
          sesión</button>
      </li>
    </ul>
  </li>
</template>

<script setup>
import { onMounted } from 'vue';
import { useUserStore } from '../../store/user';

const userStore = useUserStore();

const logout = () => {
  userStore.logout();
}
</script>
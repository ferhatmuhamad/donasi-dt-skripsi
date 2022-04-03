<template>
  <div>
    <!-- Bottom Navbar -->
    <nav class="navbar navbar-expand navbar-light fixed-bottom d-md-none d-lg-none d-xl-none" style="background-color: #f4f4f4;">
      <ul class="navbar-nav nav-justified w-100">
        <li class="nav-item">
          <router-link to="/" class="nav-link">
            <div>
              <font-awesome-icon icon="fa-solid fa-house-chimney" />
            </div>
            <div style="font-size: 8px">
              Beranda
            </div>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/myfunding" class="nav-link">
            <div>
              <font-awesome-icon icon="fa-solid fa-clipboard-list" />
            </div>
            <div style="font-size: 8px">
              Donasi
            </div>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to class="nav-link">
            <div>
              <font-awesome-icon icon="fa-solid fa-envelope" />
            </div>
            <div style="font-size: 8px">
              Pesan
            </div>
          </router-link>
        </li>
        <li class="nav-item">
          <router-link to="/account" class="nav-link">
            <div>
              <font-awesome-icon icon="fa-solid fa-user" />
            </div>
            <div style="font-size: 8px">
              Akun
            </div>
          </router-link>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
import { faClipboardList, faEnvelope, faHouseChimney, faUser } from '@fortawesome/free-solid-svg-icons'
import { library } from '@fortawesome/fontawesome-svg-core'
library.add(faHouseChimney, faClipboardList, faEnvelope, faUser)

export default {
  name: 'NavbarBottomComponent'
};
</script>

<style>
</style>
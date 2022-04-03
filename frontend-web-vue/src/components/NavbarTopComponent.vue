<template>
  <div>
    <div class="d-block d-md-block d-sm-block d-xl-none d-lg-none">
      <nav class="navbar navbar-bg-navbar-top fixed-top shadow bg-light">
        <div class="container">

          <!-- for mobile -->
          <div style="max-width: fit-content" class="mx-0">
            <b-icon-circle-fill style="font-size: 18px" v-b-toggle.sidebar v-if="this.$route.path == '/' || this.$route.path == '/investasi' || this.$route.path == '/bantuan' || this.$route.path == '/akun' || this.$route.path == '/trx'" />
            <b-icon-chevron-left class="effect" variant="secondary" v-else />
          </div>

          <!-- for mobile -->
          <div style="width: 80%">
            <form @click.prevent="">
              <input type="text" class="form-control inputsm" style="width: 100%" placeholder="Cari Donasi...">
            </form>
          </div>

          <!-- for mobile -->
          <div style="max-widht: fit-content">
            <b-icon-grid3x3-gap class="effect" variant="secondary" />
          </div>

        </div>
      </nav>  
    </div>
  </div>
</template>

<script>
export default {
  name: 'NavbarTopComponent'
}
</script>

<style>

</style>
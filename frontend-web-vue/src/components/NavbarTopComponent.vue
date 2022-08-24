<template>
  <div>
    <div class="d-block d-md-block d-sm-block d-xl-none d-lg-none">
      <nav class="navbar navbar-bg-navbar-top fixed-top shadow bg-sekunder text-light" style="height: 60px;">
        <div class="container">
          <!-- for mobile -->
          <div style="max-width: fit-content" class="mx-0" v-if="this.$route.name == 'Home'">
            <b-icon-circle-fill style="font-size: 18px" v-b-toggle.sidebar v-if="this.$route.path == '/' || this.$route.path == '/myfunding' || this.$route.path == '/account'" />
            <b-icon-chevron-left @click="goBack()" class="effect" variant="secondary" v-else />
          </div>
          <div v-else>
            <b-icon-blank v-if="this.$route.path == '/' || this.$route.path == '/myfunding' || this.$route.path == '/account'" />
            <b-icon-chevron-left @click="goBack()" class="effect" variant="secondary" v-else />
          </div>

          <!-- for mobile -->
          <div style="width: 80%" :hidden="this.$route.name != 'Home'" v-if="this.$route.name == 'Home'">
            <input type="text" class="form-control" style="width: 100%;" placeholder="Cari donasi ..." @click="goToSearch()"/>
          </div>
          <div style="width: 80%" class="text-center font-weight-bold" v-else>
            {{ title }}
          </div>

          <!-- for mobile -->
          <div style="max-widht: fit-content" v-if="this.$route.name == 'Home'">
            <b-icon-grid3x3-gap class="effect" variant="light" />
          </div>
          <div v-else>
            <b-icon-blank />
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: "NavbarTopComponent",
  title: null,

  methods: {
    goBack() {
      this.$router.go(-1);
    },
    goToSearch() {
      this.$router.push('/search');
    }
  },

  beforeMount() {
    this.title = this.$route.name;
  }
};
</script>

<style></style>
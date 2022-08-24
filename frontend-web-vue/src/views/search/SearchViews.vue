<template>
  <div>
    <div class="d-block d-md-block d-sm-block d-xl-none d-lg-none">
      <nav class="navbar navbar-bg-navbar-top fixed-top shadow" style="height: 60px;">
        <div class="container">
          <div class="row">
            <div class="col-auto my-auto">
              <b-icon-chevron-left @click="goBack()" class="effect" variant="secondary" />
            </div>
            <div class="col">
              <input type="text" class="form-control w-auto" style="width: 100%;" placeholder="Cari donasi ..." />
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchView",

  methods: {
    goBack() {
      this.$router.go(-1);
    }
  }
};
</script>

<style></style>
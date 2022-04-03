<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <navbar-bottom-component></navbar-bottom-component>

      <!-- donasi views -->
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="row mx-1 border p-2 mt-2" style="border-radius: 5px" v-for="i in 5" :key="i">
              <!-- <div class="col-auto">
                <img class="img-fluid" style="max-width: 60px" src="https://www.logodesign.net/images/illustration-logo.png" alt="">
              </div> -->
              <div class="col">
                <div style="font-size: 10px">
                  <div>
                    Pembebasan Lahan Untuk Perluasan Area Yayasan Daarut Taqwa Ihsaniyya
                  </div>
                  <div class="mt-2">
                    <div class="d-inline">17 Sept 2021</div>
                    <div class="d-inline font-weight-bold ml-4">Rp. 150.000</div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="badge badge-warning" style="font-size: 8px">pending</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavbarBottomComponent from '../../components/NavbarBottomComponent.vue'
import NavbarTopComponent from '../../components/NavbarTopComponent.vue'
export default {
  name: 'DonasiViews',
  components: { NavbarTopComponent, NavbarBottomComponent },

}
</script>

<style>

</style>
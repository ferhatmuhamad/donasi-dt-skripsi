<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <navbar-bottom-component></navbar-bottom-component>
      <div class="row">
        <div class="col">
          
          <div class="row">
            <div class="col text-center">
              <div class="font-weight-bold" style="font-size: 20px">
                Terima Kasih!
              </div>
              <div class="mt-2">
                Donasi Anda telah Kami terima
              </div>
              <div class="mt-4">
                <img class="img-fluid" style="max-height: 200px" src="https://cdn.dribbble.com/users/5126936/screenshots/14002963/media/f395c66c9f7455846001fe772ef14482.png?compress=1&resize=400x300&vertical=top" alt="">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col mx-2 mt-4">
              <div class="border">
                <table class="table table-borderless text-center" style="font-size: 12px">
                  <tr>
                    <td>Tanggal</td>
                    <td>19 September 2021</td>
                  </tr>
                  <tr>
                    <td>ID Donasi</td>
                    <td>#DNS202109190001</td>
                  </tr>
                  <tr>
                    <td>Status</td>
                    <td>Sukses</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>

          <div class="row mt-4">
            <div class="col">
              <hr>
            </div>
          </div>

          <div class="container">
            <div class="row">
              <div class="col">
                <div class="form-group mt-3">
                  <div>Nominal Donasi</div>
                  <div class="form-control bg-light mt-2">
                    Rp. 700.000
                  </div>
                </div>
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
  components: { NavbarTopComponent, NavbarBottomComponent },

}
</script>

<style>

</style>
<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <banner-component></banner-component>

      <!-- detail section campaign -->
      <div class="container" style="margin-top: 60px">

        <div class="row">
          <div class="col">
            <div class="row">
              <div class="col">
                <div class="font-weight-bold">Pembebasan Lahan Untuk Perluasan Area Yayasan Daarut Taqwa Ihsaniyya</div>
              </div>
            </div>

            <div class="row mt-4" style="font-size: 12px">
              <div class="col">
                <b-icon-person></b-icon-person> 98 Donatur
              </div>
              <div class="col">
                <div class="col text-right">98%</div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="progress mt-2" style="border-radius: 40px">
                  <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #123c9a" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>

            <div class="row mt-3" style="font-size: 14px">
              <div class="col">
                <div class="font-weight-bold">
                  Rp. 120.122.500
                </div>
                <div>
                  Terkumpul
                </div>
              </div>
              <div class="col text-right">
                <div class="font-weight-bold">
                  Rp. 150.000.000
                </div>
                <div>
                  Dibutuhkan
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="text-justify" style="font-size: 12px">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <hr>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <list-donatur-campaign></list-donatur-campaign>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BannerComponent from "../../../components/BannerComponent.vue";
import ListDonaturCampaign from '../../../components/ListDonaturCampaign.vue';
import NavbarTopComponent from "../../../components/NavbarTopComponent.vue";
export default {
  components: { NavbarTopComponent, BannerComponent, ListDonaturCampaign },
  name: "CampaignDetailViews",
};
</script>

<style>
</style>
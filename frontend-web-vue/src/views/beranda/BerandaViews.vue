<template>
  <div>
      <!-- mobile view -->
      <!-- header -->
      <div style="margin-bottom: 100px; margin-top: 70px">
        <navbar-top-component></navbar-top-component>
        <banner-component></banner-component>

        <div class="container">
          <div class="row mt-4">
            <div class="col">
              <hr>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row mt-4">
            <div class="col">
              <campaign-card-component></campaign-card-component>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row mt-4">
            <div class="col">
              <hr>
            </div>
          </div>
        </div>

        <div class="container">
          <div class="row mt-4">
            <div class="col">
              <doa-component></doa-component>
            </div>
          </div>
        </div>

        <navbar-bottom-component></navbar-bottom-component>

      </div>
  </div>
</template>

<script>
import BannerComponent from '../../components/BannerComponent.vue'
import CampaignCardComponent from '../../components/CampaignCardComponent.vue'
import DoaComponent from '../../components/DoaComponent.vue'
import NavbarBottomComponent from '../../components/NavbarBottomComponent.vue'
import NavbarTopComponent from '../../components/NavbarTopComponent.vue'
export default {
  components: {
    BannerComponent,
    CampaignCardComponent,
    DoaComponent,
    NavbarBottomComponent,
    NavbarTopComponent
  }
}
</script>

<style>


</style>
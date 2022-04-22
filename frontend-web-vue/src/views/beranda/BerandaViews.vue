<template>
  <div>
      <!-- mobile view -->
      <!-- header -->
      <div style="margin-bottom: 100px; margin-top: 70px">
        <navbar-top-component></navbar-top-component>
        <banner-component :banners="banners"></banner-component>

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
              <campaign-card-component :campaigns="campaigns"></campaign-card-component>
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
              <doa-component :doa="doa"></doa-component>
            </div>
          </div>
        </div>

        <navbar-bottom-component></navbar-bottom-component>

      </div>
  </div>
</template>

<script>
import axios from 'axios'
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
  },

  data() {
    return {
      campaigns: [],
      banners: [],
      doa: []
    }
  },

  beforeMount() {
    this.getBanner();
    this.getCampaigns();
    this.getDoa();
  },

  methods: {
    getCampaigns() {
      axios.get(process.env.VUE_APP_API + 'campaigns').then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.campaigns = resp.data.data;
        }
      })
    },

    getDoa() {
      axios.get(process.env.VUE_APP_API + 'doa').then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.doa = resp.data.data;
        }
      })
    },

    getBanner() {
      axios.get(process.env.VUE_APP_API + 'banner').then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.banners = resp.data.data;
        }
      })
    }
  }
}
</script>

<style>


</style>
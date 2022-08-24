<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <banner-campaign-component :banners="campaign"></banner-campaign-component>

      <!-- detail section campaign -->
      <div class="container" style="margin-top: 60px">

        <div class="row">
          <div class="col">
            <div class="row">
              <div class="col">
                <div class="font-weight-bold">{{campaign.campaign_title}}</div>
              </div>
            </div>

            <div class="row mt-4" style="font-size: 12px">
              <div class="col">
                <b-icon-person></b-icon-person> {{campaign.backer_count}} Donatur
              </div>
              <div class="col">
                <div class="col text-right">{{((campaign.current_amount/campaign.goal_amount) * 100).toFixed(2)}}%</div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <!-- <div class="progress mt-2" style="border-radius: 40px">
                  <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #123c9a" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <b-progress max="100" class="mt-4" style="height: 10px">
                  <b-progress-bar :value="(campaign.current_amount/campaign.goal_amount) * 100" style="background-color: #123C9A;"></b-progress-bar>
                </b-progress>
              </div>
            </div>

            <div class="row mt-4" style="font-size: 14px">
              <div class="col">
                <div class="font-weight-bold">
                  Rp. {{Number(campaign.current_amount).toLocaleString('id')}}
                </div>
                <div>
                  Terkumpul
                </div>
              </div>
              <div class="col text-right">
                <div class="font-weight-bold">
                  Rp. {{Number(campaign.goal_amount).toLocaleString('id')}}
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
                  {{campaign.description}}
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
                <list-donatur-campaign :backer="campaign.backer" :backer_count="campaign.backer_count"></list-donatur-campaign>
              </div>
            </div>

            <div class="fixed-bottom bg-white border-top">
              <div class="row p-2">
                <div class="col" style="max-width: fit-content">
                  <button class="btn text-white p-2" style="background-color: #123C9A"> <b-icon-share-fill></b-icon-share-fill> </button>
                </div>
                <div class="col">
                  <button @click="goFunding()" class="btn text-white p-2 btn-block" style="background-color: #123C9A">Donasi Sekarang</button>
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
import axios from 'axios';
import BannerCampaignComponent from "../../../components/BannerCampaignComponent.vue";
import ListDonaturCampaign from '../../../components/ListDonaturCampaign.vue';
import NavbarTopComponent from "../../../components/NavbarTopComponent.vue";
export default {
  components: { NavbarTopComponent, ListDonaturCampaign, BannerCampaignComponent },
  name: "CampaignDetailViews",

  data() {
    return {
      slug: this.$route.params.slug,

      // campaign
      campaign: {}
    }
  },

  beforeMount() {
    this.getDataCampaign();
  },

  methods: {
    getDataCampaign() {
      axios.get(process.env.VUE_APP_API + 'campaign/slug/' + this.slug, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.campaign = resp.data.data;
        }
      })
    },

    goFunding() {
      if(this.campaign.user == null) {
        console.log('kosong');
      } else {
        this.$router.push(this.slug + '/fund');
      }
    }
  }
};
</script>

<style>
</style>
<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <navbar-bottom-component></navbar-bottom-component>

      <!-- donasi views -->
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="row mx-1 border p-2 mt-2" style="border-radius: 5px" v-for="index in donation" :key="index.id_donasi" @click="goDetail(index)">
              <!-- <div class="col">
                <div class="fs14">
                  <div>
                    {{index.campaign_title}}
                  </div>
                  <div class="mt-2">
                    <div class="d-inline"> {{index.time}} </div>
                    <div class="d-inline font-weight-bold ml-4 text-right">Rp. {{Number(index.amount).toLocaleString('id')}}</div>
                  </div>
                </div>
              </div>
              <div class="col-auto">
                <div class="badge badge-warning" style="font-size: 8px" v-if="index.status == 'pending'">pending</div>
                <div class="badge badge-success" style="font-size: 8px" v-else-if="index.status == 'approved'">sukses</div>
              </div> -->
              <div class="col">
                <div class="row fs14">
                  <div class="col font-weight-bold">
                    {{ index.campaign_title }}
                  </div>
                  <div class="col-auto">
                    <div class="border p-1 rounded px-2 bg-tersier" style="font-size: 10px" v-if="index.status == 'pending'">Pending</div>
                    <div class="border p-1 rounded px-2 bg-sekunder text-white" style="font-size: 10px" v-else-if="index.status == 'success'">Berhasil</div>
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col fs12">
                    {{ index.time }}
                  </div>
                  <div class="col text-right font-weight-bold fs14">
                    Rp. {{ Number(index.amount).toLocaleString("id") }}
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
import axios from "axios";
import NavbarBottomComponent from "../../components/NavbarBottomComponent.vue";
import NavbarTopComponent from "../../components/NavbarTopComponent.vue";
export default {
  name: "DonasiViews",
  components: { NavbarTopComponent, NavbarBottomComponent },

  data() {
    return {
      donation: null
    };
  },

  beforeMount() {
    this.loadDataDonasi();
  },

  methods: {
    async loadDataDonasi() {
      await axios
        .post(
          process.env.VUE_APP_API + "mydonation",
          {},
          {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token")
            }
          }
        )
        .then(resp => {
          console.log(resp);
          if (resp.data.meta.status == "success") {
            this.donation = resp.data.data;
          }
        });
    },

    goDetail(index) {
      if (index.status == "pending") {
        // this.$router.push('/myfunding/' + index.id_donasi);
        console.log("button link");
      } else if (index.status == "approved") {
        this.$router.push("/myfunding/" + index.id_donasi);
      }
    }
  }
};
</script>

<style></style>
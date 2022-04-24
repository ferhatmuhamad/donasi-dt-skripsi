<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <navbar-bottom-component></navbar-bottom-component>
      
      <vue-element-loading :active="isActive" spinner="bar-fade-scale" color="#31a05f" />

      <div class="container">
        <div class="row">
          <div class="col">
            <div class="row">
              <div class="col text-center">
                <div class="font-weight-bold" style="font-size: 20px">Terima Kasih!</div>
                <div class="mt-2">Donasi Anda telah Kami terima</div>
                <div class="mt-4">
                  <img class="img-fluid" style="max-height: 200px" src="https://cdn.dribbble.com/users/5126936/screenshots/14002963/media/f395c66c9f7455846001fe772ef14482.png?compress=1&resize=400x300&vertical=top" alt="" />
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col mx-2 mt-4">
                <div class="border">
                  <table class="table table-borderless text-center" style="font-size: 12px">
                    <tr>
                      <td>Tanggal</td>
                      <td>{{ detailDonasi.time }}</td>
                    </tr>
                    <tr>
                      <td>ID Donasi</td>
                      <td>#{{ detailDonasi.kode_donasi }}</td>
                    </tr>
                    <tr>
                      <td>Status</td>
                      <td>
                        <div v-if="detailDonasi.status == 'approved'">Sukses</div>
                      </td>
                    </tr>
                  </table>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col">
                <hr />
              </div>
            </div>

            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="form-group mt-3">
                    <div>Nominal Donasi</div>
                    <div class="form-control bg-light mt-2">Rp. {{ Number(detailDonasi.amount).toLocaleString("id") }}</div>
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
  components: { NavbarTopComponent, NavbarBottomComponent },

  data() {
    return {
      id_donasi: this.$route.params.id_funding,

      detailDonasi: {},

      isActive: false
    };
  },

  beforeMount() {
    this.isActive = true;
    this.loadDetailDonasi().then(() => {
      this.isActive = false;
    });
  },

  methods: {
    async loadDetailDonasi() {
      await axios
        .post(
          process.env.VUE_APP_API + "mydonation/" + this.id_donasi,
          {},
          {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          }
        )
        .then((resp) => {
          console.log(resp);
          if (resp.data.meta.status == "success") {
            this.detailDonasi = resp.data.data;
          }
        });
    },
  },
};
</script>

<style>
</style>
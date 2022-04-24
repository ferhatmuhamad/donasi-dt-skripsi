<template>
  <div style="margin-top: 70px; margin-bottom: 100px">
    <navbar-top-component></navbar-top-component>

    <vue-element-loading :active="isActive" spinner="bar-fade-scale" color="#31a05f" />

    <div class="container">
      <div class="row">
        <div class="col">
          <div class="row border mx-2">
            <div class="col" style="max-width: fit-content">
              <img style="max-width: 80px" src="https://cdn.sstatic.net/Img/teams/teams-illo-free-sidebar-promo.svg?v=47faa659a05e" class="img-fluid" />
            </div>

            <div class="col" style="font-size: 9px">
              <div class="font-weight-bold">Anda akan berdonasi di program ini :</div>
              <div class="mt-2">
                <div class="">Pembebasan Lahan Untuk Perluasan Area Yayasan Daarut Taqwa Ihsaniyaa</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row border mx-2 mt-4 pb-2" style="border-radius: 4px" v-if="errorMessage">
        <div class="col" style="font-size: 12px">
          <!-- nominal -->
          <div class="form-group mt-3">
            <div class="alert alert-danger">
              {{this.errorMessage}}
            </div>
          </div>
        </div>
      </div>

      <div class="row border mx-2 mt-4 pb-2" style="border-radius: 4px">
        <div class="col" style="font-size: 12px">
          <!-- nominal -->
          <div class="form-group mt-3">
            <label for="nominaldonasi" class="font-weight-bold">Nominal Donasi</label>
            <input type="number" class="form-control" id="nominaldonasi" placeholder="Rp. " v-model="filled.nominal" />
          </div>

          <!-- bank pengirim -->
          <div class="form-group mt-3">
            <label for="bankpengirim" class="font-weight-bold">Bank Pengirim</label>
            <select class="form-control" id="bankpengirim" style="font-size: 12px" v-model="filled.bank">
              <option value="null">Pilih Bank</option>
              <option>BCA</option>
              <option>BRI</option>
              <option>BNI</option>
              <option>BTPN</option>
              <option>Bank Mandiri</option>
            </select>
          </div>

          <!-- nama donatur -->
          <div class="form-group mt-3">
            <label for="namadonatur" class="font-weight-bold">Donatur</label>
            <input type="text" class="form-control" id="namadonatur" placeholder="Nama..." style="font-size: 12px" v-model="filled.nama" />
          </div>

          <!-- donasi anomin -->
          <div class="custom-control custom-switch my-auto mt-3" >
            <input type="checkbox" class="custom-control-input" id="donasianonim" v-model="filled.statusAnonym" />
            <label class="custom-control-label" for="donasianonim" style="font-size: 14px" >Donasi Anonim (Sembunyikan Nama Saya)</label>
          </div>

          <!-- doa field -->
          <div>
            <textarea id="doa" cols="30" rows="10" class="form-control mt-3 mb-3" placeholder="Tulis doa Anda di sini!" style="font-size: 12px" v-model="filled.doaText"></textarea>
          </div>

          <!-- donasi anomin -->
          <div class="custom-control custom-switch my-auto mt-3" >
            <input type="checkbox" class="custom-control-input" id="tampilkandoa" v-model="filled.showDoa" />
            <label class="custom-control-label" for="tampilkandoa" style="font-size: 14px">Tampilkan doa di halaman</label>
          </div>
        </div>
      </div>

      <div class="fixed-bottom bg-white border-top">
        <div class="row py-2">
          <div class="col mx-2">
            <button class="btn text-white btn-block" style="background-color: #123C9A" @click="pressButtonDoansi()">Tunaikan Sekarang</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import NavbarTopComponent from "../../../components/NavbarTopComponent.vue";
export default {
  components: { NavbarTopComponent },
  data() {
    return {
      isActive: false,

      filled: {
        nominal: null,
        bank: null,
        statusAnonym: false,
        doaText: null,
        showDoa: false,
        nama: null
      },

      campaign: {},
      user: {},

      slug: this.$route.params.slug,
      errorMessage: null
    }
  },

  methods: {
    async getProfile() {
      await axios.get(process.env.VUE_APP_API + 'profile', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.user = resp.data.data;

          this.filled.nama = this.user.nama;
        }
      })
    },

    async getDataCampaign() {
      await axios.get(process.env.VUE_APP_API + 'campaign/slug/' + this.slug, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.campaign = resp.data.data;
        }
      })
    },

    async prosesFund() {
      await axios.post(process.env.VUE_APP_API + 'donasi/' + this.campaign.id_campaign, {
        amount: this.filled.nominal,
      }, {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then((resp) => {
        if(resp.data.meta.status == 'success') {
          // lanjut ke hal konfirmasi
          let code_donasi = resp.data.data.kode_donasi;
          this.$router.push('/campaign/' + code_donasi + '/confirm')
        } else {
          // give error message
          this.errorMessage = "Mohon maaf, permintaan tidak dapat diproses, silahkan coba kembali!";
        }
      })
    },

    async pressButtonDoansi() {
      this.isActive = true;
      this.errorMessage = null;

      if(this.filled.nominal == null || this.filled.nominal == 0 || this.filled.bank == null || this.filled.nama == null || this.filled.nama == "" ) {
        this.errorMessage = "Mohon cek kelengkapan data Anda";
      } else {
        this.prosesFund().then(() => {
          this.isActive = false;
        })
      }
    }
  },

  beforeMount() {
    this.isActive = true;
    
    this.getProfile().then(() => {
      this.getDataCampaign();
    }).then(() => {
      this.isActive = false;
    });
  }

}
</script>

<style>
</style>
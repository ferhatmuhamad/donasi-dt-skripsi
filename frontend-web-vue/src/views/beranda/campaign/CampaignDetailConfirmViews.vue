<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none">
      <div style="margin-top: 70px; margin-bottom: 100px">
        <!-- navbar -->
        <navbar-top-component></navbar-top-component>

        <!-- body -->
        <div class="container">
          <div class="border mx-2" style="border-radius: 5px">
            <div class="row text-center mt-4">
              <div class="col">
                <div>
                  No Pembayaran
                </div>
                <div class="font-weight-bold">
                  {{transaction.kode_donasi}}
                </div>
              </div>
            </div>

            <div class="row mt-4 text-center">
              <div class="col">
                <div>
                  Total Pembayaran
                </div>
                <div class="font-weight-bold">
                  Rp. {{Number(transaction.amount).toLocaleString('id')}}
                </div>
              </div>
            </div>

            <div class="row text-center mt-4">
              <div class="col">
                Silahkan Transfer ke
              </div>
            </div>

            <div class="row mt-4">
              <div class="col text-center">
                <div class="border mx-2 p-2" style="border-radius: 5px">
                  <div>
                    <img class="img-fluid" style="max-width: 100px" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/2560px-Bank_Syariah_Indonesia.svg.png" alt="">
                  </div>
                  <div class="mt-3 font-weight-bold">
                    1234567891011
                  </div>
                  <div class="mt-3">
                    a.n. Daarut Taqwa Ihsaniyya
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col text-center">
                <button class="btn btn-sm text-white" style="background-color: #123C9A"> <b-icon-paperclip></b-icon-paperclip> Salin nomor rekening </button>
              </div>
            </div>

            <div class="row mt-4">
              <div class="col text-center">
                <div>
                  Sudah transfer ?
                </div>
                <div>
                  Mohon upload bukti transfer
                </div>
              </div>
            </div>

            <div class="row mt-4 mb-4">
              <div class="col">
                <div class="border mx-2" style="border-radius: 5px">
                  <div class="row justify-content-center p-2">
                    <div class="col-auto border-right" style="font-size: 60px">
                      <b-icon-upload></b-icon-upload>
                    </div>
                    <div class="col my-auto">
                      Silahkan klik gambar untuk upload!
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="fixed-bottom bg-white border-top">
              <div class="row py-2">
                <div class="col mx-2">
                  <button class="btn text-white btn-block" style="background-color: #123C9A">Selesai</button>
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
import axios from 'axios'
import NavbarTopComponent from '../../../components/NavbarTopComponent.vue'
export default {
  components: { NavbarTopComponent },
  name: "CampaignDetailConfirmViews",

  data() {
    return {
      invoice: this.$route.params.invoice,

      transaction: {}
    }
  },

  beforeMount() {
    this.getConfirmationData();
  },

  methods: {
    async getConfirmationData() {
      await axios.get(process.env.VUE_APP_API + 'donasi/' + this.invoice + '/confirmationcode', {
        headers: {
          Authorization: 'Bearer ' + localStorage.getItem('token')
        }
      }).then((resp) => {
        if(resp.data.meta.status == 'success') {
          this.transaction = resp.data.data;
        }
      })
    }
  }
}
</script>

<style>

</style>
<template>
  <div>
    <div class="container">
      <div class="row" style="margin-top: 30px">
        <div class="col">
          <img :src="logoIMG" alt="" class="img-fluid" style="max-height: 60px" />
        </div>
      </div>

      <!-- login info -->
      <div class="row mt-4">
        <div class="col">
          <div class="font-weight-bold" style="font-size: 20px">Berhasil</div>
          <div style="font-weight: 300; font-size: 14px" class="text-muted mt-2">
              Silahkan Anda masukkan password baru Anda. Jangan sampai lupa kembali ya...
          </div>
        </div>
      </div>

      <!-- login input -->
      <form @submit.prevent="changePassword">
        <div class="row" style="margin-top: 40px">
          <div class="col" style="font-size: 14px">
            <div>
              <input type="password" class="form-control py-4 border-1" placeholder="Password Anda..." />
            </div>
            <div>
              <input type="password" class="form-control py-4 border-1 mt-2" placeholder="Konfirmasi Password Anda..." />
            </div>
          </div>
        </div>

        <!-- button login -->
        <div class="row" style="margin-top: 30px">
          <div class="col">
            <button type="submit" class="btn btn-block py-3 font-weight-bold shadow text-white" style="background-color: #12569A">Ganti Password</button>
          </div>
        </div>
      </form>

      <vue-element-loading :active="loading" spinner="bar-fade-scale" color="#12569A" />

    </div>
  </div>
</template>

<script>
import axios from 'axios';
import LogoImport from "../../assets/logo.png";
export default {
  name: "ForgetPasswordConfirmationViews",

  data() {
    return {
      logoIMG: LogoImport,

      filled: {
        password: null,
        passwordConfirmation: null
      },

      loading: false,
      token: this.$route.params.token,
      errorValidation: {}
    };


  },

  methods: {
    changePassword() {

      this.loading = true;

      axios.post(process.env.VUE_APP_API + '', {
      }).then((resp) => {
        if(resp.data.status == 'success') {
          this.loading = false;

          // do it
        } else {
          this.loading = false;

          // do it when error
        }
      }).catch(() => {
        setTimeout(() => {
          this.loading = false;
        }, 5000);
      })
    }
  }
};
</script>

<style>
</style>
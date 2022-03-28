<template>
  <div>
    <div class="container">
      <div class="row justify-content-center" style="margin-top: 50px">
        <div class="col-lg-6">
          <vue-element-loading :active="isActive" spinner="bar-fade-scale" color="#31a05f" />

          <div class="row" style="margin-top: 30px">
            <div class="col">
              <img :src="logoIMG" alt="" class="img-fluid" style="max-height: 60px" />
            </div>
          </div>

          <form @submit.prevent="login()">
            <!-- login info -->
            <div class="row mt-4">
              <div class="col">
                <div class="font-weight-bold" style="font-size: 20px">Selamat Datang</div>
                <div style="font-weight: 300" class="text-muted mt-2">Silahkan Masuk untuk melanjutkan</div>
              </div>
            </div>

            <!-- alert when error message -->
            <div v-if="errorMessageAPI != ''">
              <div class="alert alert-danger mt-4 font-weight-light">
                {{ errorMessageAPI }}
              </div>
            </div>

            <!-- login input -->
            <div class="row" style="margin-top: 40px">
              <div class="col" style="font-size: 14px">
                <div class="input-group mb-3">
                  <input type="text" class="form-control py-4" placeholder="Email Anda..." v-model="filled.email" />
                </div>

                <div class="input-group mb-3">
                  <input type="password" class="form-control py-4" placeholder="Password Anda..." v-model="filled.password" />
                </div>

              </div>
            </div>

            <!-- button login -->
            <div class="row" style="margin-top: 50px">
              <div class="col">
                <button type="submit" class="btn text-white btn-block py-3 font-weight-bold shadow" style="background-color: #12569A">Masuk</button>
              </div>
            </div>
          </form>

          <!-- forgot password -->
          <div class="row mt-4" style="font-size: 14px">
            <div class="col">
              <div class="text-center">
                <router-link to="/auth/forgotpassword" class="font-weight-bold text-black" style="color: #12569A">Lupa Password ?</router-link>
              </div>
              <div class="mt-3">
                <div><span class="text-muted" style="font-weight: 300">Belum punya akun ?</span> <router-link to="/auth/register" class="font-weight-bold" style="color: #12569A">Daftar Sekarang!</router-link></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LogoImport from "../../assets/logo.png";
import axios from "axios";
export default {
  name: "LoginViews",

  data() {
    return {
      logoIMG: LogoImport,

      filled: {
        email: "",
        password: "",
      },

      isActive: false,
      errorMessageAPI: "",
    };
  },

  methods: {
    login() {
      this.isActive = true;
      console.log("Login proses");

      this.hitAPILogin();
    },

    errorHitAPI() {
      console.log("terjadi error");
      setTimeout(() => {
        this.isActive = false;
        this.errorMessageAPI = "Sepertinya ada kesalahan. Mohon mencoba kembali";
      }, 10000);
    },

    hitAPILogin() {
      this.errorMessageAPI = "";
      axios
        .post(process.env.VUE_APP_API + "login", {
          email: this.filled.email,
          password: this.filled.password,
        })
        .then((resp) => {
          console.log(resp);
          if(resp.data.meta.status == 'success') {
            // lakukan manage vuex for user
            let token = resp.data.data.token;
            this.$store.commit('login', token);
          } else if(resp.data.meta.status == 'error') {
            // error validation
          }
          this.isActive = false;
        })
        .catch(() => {
          this.errorHitAPI();
        })
    },
  },
};
</script>

<style>
</style>
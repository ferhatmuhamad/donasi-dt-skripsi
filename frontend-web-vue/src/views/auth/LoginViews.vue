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
          <div class="font-weight-bold" style="font-size: 20px">Selamat Datang</div>
          <div style="font-weight: 300" class="text-muted mt-2">Silahkan Masuk untuk melanjutkan</div>
        </div>
      </div>

      <!-- login input -->
      <div class="row" style="margin-top: 40px">
        <div class="col" style="font-size: 14px">
          <div>
            <input type="text" class="form-control py-4 border-1" placeholder="Email Anda..." />
          </div>
          <div class="mt-2">
            <input type="password" class="form-control py-4 border-1" placeholder="Password Anda..." />
          </div>
        </div>
      </div>

      <!-- button login -->
      <div class="row" style="margin-top: 50px">
        <div class="col">
          <button class="btn text-white btn-block py-3 font-weight-bold shadow" style="background-color: #31a05f">Masuk</button>
        </div>
      </div>

      <!-- forgot password -->
      <div class="row mt-4" style="font-size: 14px">
        <div class="col">
          <div class="text-center">
            <span class="font-weight-bold" @click="goToForgetPassword()">Lupa Password ?</span>
          </div>
          <div class="mt-3">
            <div><span class="text-muted" style="font-weight: 300">Belum punya akun ?</span> <span @click="goToRegister()" class="font-weight-bold">Daftar Sekarang!</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LogoImport from "../../assets/logo.png";
export default {
  name: "LoginViews",

  data() {
    return {
      logoIMG: LogoImport,
    };
  },

  methods: {
    goToRegister() {
      this.$router.push("register");
    },

    goToForgetPassword() {
      this.$router.push("forgotpassword");
    },
  },
};
</script>

<style>
</style>
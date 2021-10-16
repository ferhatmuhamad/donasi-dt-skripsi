<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6">
          <div class="row" style="margin-top: 30px">
            <div class="col">
              <img :src="logoIMG" alt="" class="img-fluid" style="max-height: 60px" />
            </div>
          </div>

          <!-- login info -->
          <div class="row mt-4">
            <div class="col">
              <div class="font-weight-bold" style="font-size: 20px">Anda Lupa Password ?</div>
              <div style="font-weight: 300; font-size: 14px" class="text-muted mt-2">Jangan khawatir, cukup masukkan email Anda dan Kami akan kirimkan link penggantian password</div>
            </div>
          </div>

          <!-- login input -->
          <div class="row" style="margin-top: 40px">
            <div class="col" style="font-size: 14px">
              <div>
                <input type="text" class="form-control py-4 border-1" placeholder="Email Anda..." />
              </div>
            </div>
          </div>

          <!-- button login -->
          <div class="row" style="margin-top: 30px">
            <div class="col">
              <button class="btn text-white btn-block py-3 font-weight-bold shadow" style="background-color: #31a05f">Kirim</button>
            </div>
          </div>

          <div class="mt-4" @click="kembali()">Kembali</div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LogoImport from "../../assets/logo.png";
export default {
  name: "ForgetPasswordViews",

  data() {
    return {
      logoIMG: LogoImport,
    };
  },

  methods: {
    kembali() {
      this.$router.go(-1);
    }
  }
};
</script>

<style>
</style>
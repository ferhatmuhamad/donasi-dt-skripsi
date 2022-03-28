<template>
  <div>
    <div class="container">
      <div class="row justify-content-center" style="margin-top: 50px">
        <div class="col-lg-6">
          <div class="row" style="margin-top: 30px">
            <div class="col">
              <img :src="logoIMG" alt="" class="img-fluid" style="max-height: 60px" />
            </div>
          </div>

          <!-- login info -->
          <div class="row mt-4">
            <div class="col">
              <div class="font-weight-bold" style="font-size: 20px">Mari Kita Mulai</div>
              <div style="font-weight: 300" class="text-muted mt-2">Buat akun baru Anda</div>
            </div>
          </div>

          <!-- login input -->
          <div class="row" style="margin-top: 40px">
            <div class="col" style="font-size: 14px">
              <div>
                <input type="text" class="form-control py-4 border-1" placeholder="Nama Anda..." />
              </div>
              <div>
                <input type="email" class="form-control py-4 border-1 mt-2" placeholder="Email Anda..." />
              </div>
              <div>
                <input type="password" class="form-control py-4 border-1 mt-2" placeholder="Password Anda..." />
              </div>
              <div>
                <input type="password_confirmation" class="form-control py-4 border-1 mt-2" placeholder="Konfirmasi Password ..." />
              </div>
              <div>
                <input type="hp" class="form-control py-4 border-1 mt-2" placeholder="No HP/WA..." />
              </div>
            </div>
          </div>

          <!-- button login -->
          <div class="row mt-3">
            <div class="col">
              <button class="btn text-white btn-block py-3 font-weight-bold shadow" style="background-color: #12569A">Daftar Sekarang</button>
            </div>
          </div>

          <!-- forgot password -->
          <div class="row mt-4" style="font-size: 14px">
            <div class="col">
              <div><span class="text-muted" style="font-weight: 300">Sudah punya akun ? </span> <span @click="goToLogin()">Silahkan Login!</span></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LogoImport from "../../assets/logo.png";
export default {
  name: "RegisterViews",

  data() {
    return {
      logoIMG: LogoImport,
    };
  },

  methods: {
    goToLogin() {
      this.$router.push("login");
    },
  },
};
</script>

<style>
</style>
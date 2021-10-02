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
          <button class="btn btn-success btn-block py-3 font-weight-bold shadow">Ganti Password</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import LogoImport from "../../assets/logo.png";
export default {
  name: "ForgetPasswordConfirmationViews",

  data() {
    return {
      logoIMG: LogoImport,
    };
  },
};
</script>

<style>
</style>
<template>
  <div style="margin-top: 70px; margin-bottom: 100px">
    <navbar-top-component></navbar-top-component>

    <div>
      <div class="row">
        <div class="col">
          <div class="row border mx-2">
            <div class="col" style="max-width: fit-content">
              <img style="max-width: 80px" src="https://cdn.sstatic.net/Img/teams/teams-illo-free-sidebar-promo.svg?v=47faa659a05e" class="img-fluid" />
            </div>

            <div class="col" style="font-size: 10px">
              <div class="font-weight-bold">Anda akan berdonasi di program ini :</div>
              <div class="mt-2">
                <div class="">Pembebasan Lahan Untuk Perluasan Area Yayasan Daarut Taqwa Ihsaniyaa</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row border mx-2 mt-4 pb-2" style="border-radius: 4px">
        <div class="col" style="font-size: 12px">
          <!-- nominal -->
          <div class="form-group mt-3">
            <label for="nominaldonasi" class="font-weight-bold">Nominal Donasi</label>
            <input type="number" class="form-control" id="nominaldonasi" placeholder="Rp. " />
          </div>

          <!-- bank pengirim -->
          <div class="form-group mt-3">
            <label for="bankpengirim" class="font-weight-bold">Bank Pengirim</label>
            <select class="form-control" id="bankpengirim" style="font-size: 12px">
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
            <input type="text" class="form-control" id="namadonatur" placeholder="Nama..." value="Andri Nur Hidayatulloh" style="font-size: 12px" />
          </div>

          <!-- donasi anomin -->
          <div class="custom-control custom-switch my-auto mt-3" >
            <input type="checkbox" class="custom-control-input" id="donasianonim" />
            <label class="custom-control-label" for="donasianonim" style="font-size: 14px">Donasi Anonim (Sembunyikan Nama Saya)</label>
          </div>

          <!-- doa field -->
          <div>
            <textarea id="doa" cols="30" rows="10" class="form-control mt-3 mb-3" placeholder="Tulis doa Anda di sini!" style="font-size: 12px"></textarea>
          </div>

          <!-- donasi anomin -->
          <div class="custom-control custom-switch my-auto mt-3" >
            <input type="checkbox" class="custom-control-input" id="tampilkandoa" />
            <label class="custom-control-label" for="tampilkandoa" style="font-size: 14px">Tampilkan doa di halaman</label>
          </div>
        </div>
      </div>

      <div class="fixed-bottom bg-white border-top">
        <div class="row py-2">
          <div class="col mx-2">
            <button class="btn text-white btn-block" style="background-color: #123C9A">Tunaikan Sekarang</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import NavbarTopComponent from "../../../components/NavbarTopComponent.vue";
export default {
  components: { NavbarTopComponent },
};
</script>

<style>
</style>
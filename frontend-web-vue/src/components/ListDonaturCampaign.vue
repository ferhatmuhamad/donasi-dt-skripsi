<template>
  <div>
    <div>
      <div class="row">
        <div class="col">
          Para Donatur (98)
        </div>
      </div>

      <div>
        <div class="row mt-4" v-for="i in 10" :key="i">
          <div class="col" style="max-width: fit-content">
            <b-icon-circle-fill></b-icon-circle-fill>
          </div>
          <div class="col">
            <div style="font-size: 12px">
              Anonim
            </div>
            <div class="mt-2" style="font-size: 8px">
              2 jam yang lalu
            </div>
            <div class="mt-2 font-italic" style="font-size: 8px">
              Semoga Allah mudahkan segala urusan dalam pembangunan ini. Aamiin
            </div>
          </div>
          <div class="col" style="max-width: fit-content">
            <div style="font-size: 12px">
              Rp. 120.000
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4">
        <div class="col text-center">
          <button class="btn text-white" style="font-size: 12px; background-color: #123C9A">Tampilkan Lebih Banyak</button>
        </div>
      </div>

      <div class="fixed-bottom bg-white border-top">
        <div class="row p-2">
          <div class="col" style="max-width: fit-content">
            <button class="btn text-white p-2" style="font-size: 12px; background-color: #123C9A"> <b-icon-share-fill></b-icon-share-fill> </button>
          </div>
          <div class="col">
            <button class="btn text-white p-2 btn-block" style="font-size: 12px; background-color: #123C9A">Donasi Sekarang</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ListDonaturCampaign'
}
</script>

<style>

</style>
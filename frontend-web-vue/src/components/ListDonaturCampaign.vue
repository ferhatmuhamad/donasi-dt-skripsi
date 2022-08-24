<template>
  <div>
    <div>
      <div class="row">
        <div class="col">
          Para Donatur ({{backer_count}})
        </div>
      </div>

      <div>
        <div class="row mt-4" v-for="index in backer" :key="index.id_donasi">
          <div class="col" style="max-width: fit-content">
            <b-icon-circle-fill></b-icon-circle-fill>
          </div>
          <div class="col">
            <div style="font-size: 12px">
              {{index.nama}}
            </div>
            <div class="mt-2" style="font-size: 8px">
              {{getTimeNow(index.created_at)}}
            </div>
            <div class="mt-2 font-italic" style="font-size: 8px" v-if="index.doa">
              {{index.doa.doa_text}}
            </div>
          </div>
          <div class="col" style="max-width: fit-content">
            <div style="font-size: 12px">
              Rp. {{Number(index.amount).toLocaleString('id')}}
            </div>
          </div>
        </div>
      </div>

      <div class="row mt-4" v-if="backer_count > 0">
        <div class="col text-center">
          <button class="btn text-white" style="font-size: 12px; background-color: #123C9A">Tampilkan Lebih Banyak</button>
        </div>
      </div>

    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: 'ListDonaturCampaign',

  props: {
    backer: Array,
    backer_count: Number
  },

  methods: {
    getTimeNow(timeNow) {
      return moment(timeNow).locale('id').fromNow();
    }
  },
}
</script>

<style>

</style>
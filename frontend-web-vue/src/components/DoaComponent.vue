<template>
  <div>
    <div>
      <div class="font-weight-bold" style="color: #838383">Do'a Orang Baik</div>

      <div>
        <div class="wrapper mt-3">
          <div class="card mr-2" style="width: 18rem" v-for="index in doa" :key="index.id_doa">
            <div class="card-body shadow p-3">
              <div class="row">
                <div class="col text-truncate" style="font-size: 10px">{{index.nama}}</div>
                <div class="col text-right" style="font-size: 8px">{{getTimeNow(index.created_at)}}</div>
              </div>

              <div class="row mt-3">
                <div class="col text-truncate" style="font-size: 14px">{{index.doa_text}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from 'moment';
export default {
  name: "DoaComponent",
  props: {
    doa: Array
  },

  methods: {
    getTimeNow(timeNow) {
      return moment(timeNow).locale('id').fromNow();
    }
  },
};
</script>

<style>
</style>
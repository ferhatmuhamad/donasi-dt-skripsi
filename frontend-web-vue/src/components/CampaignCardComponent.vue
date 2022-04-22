<template>
  <div>
      <div>
        <div class="row">
          <div class="col">
            <div class="font-weight-bold" style="color: #838383">
              Donasi Dibuka
            </div>
          </div>
        </div>
      </div>
      <div class="wrapper mt-3">
          <div class="card mr-2" style="width: 18rem;" v-for="index in campaigns" :key="index.id_campaign">
            <img :src="index.path" class="card-img-top" style="max-height: 150px; object-position: center; object-fit: cover">
                <div class="card-body shadow p-2">
                    <div class="text-truncate mt-2">
                      {{index.campaign_title}}
                    </div>

                    <div class="mt-3">
                      <!-- <div class="progress mt-2" style="border-radius: 40px;">
                        <div class="progress-bar" role="progressbar" :style="{width: ((index.current_amount/index.goal_amount) * 100).toFixed(0)}+'%'" style="background-color: #123C9A" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div> -->
                      <b-progress max="100" class="mt-2" style="height: 10px">
                        <b-progress-bar :value="(index.current_amount/index.goal_amount) * 100" style="background-color: #123C9A;"></b-progress-bar>
                      </b-progress>
                      <div class="text-right mt-1" style="font-size: 10px; color: #838383">
                        {{((index.current_amount/index.goal_amount) * 100).toFixed(2)}}%
                      </div>
                    </div>
                    

                    <div class="mt-2">
                      <div class="font-weight-bold" style="font-size: 12px; color: #123C9A">
                        Rp. {{Number(index.current_amount).toLocaleString('id')}}
                      </div>
                      <div style="font-size: 10px">
                        Terkumpul
                      </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'CampaignCardComponent',
  props: {
    campaigns: Array
  }
}
</script>

<style>
.wrapper {
  max-height: fit-content;
  display: flex;
  overflow-x: auto;
}

.wrapper::-webkit-scrollbar {
  width: 0;
}

.wrapper .card {
  min-width: 310px;
  box-shadow: 0px 6px 11px -8px #555;
}


</style>
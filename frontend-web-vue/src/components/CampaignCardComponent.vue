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
          <div class="card mr-2" style="width: 18rem;" v-for="i in 5" :key="i">
            <img src="https://dwblog-ecdf.kxcdn.com/wp-content/uploads/2019/08/dewaweb-blog-manfaat-campaign-untuk-kesuksesan-bisnismu-revisi-3.png" class="card-img-top" style="max-height: 150px; object-position: center; object-fit: cover">
                <div class="card-body shadow p-2">
                    <div class="text-truncate mt-2">
                      Judul Campaign
                    </div>

                    <div class="mt-3">
                      <div class="progress mt-2" style="border-radius: 40px;">
                        <div class="progress-bar" role="progressbar" style="width: 25%; background-color: #123C9A" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                      <div class="text-right mt-1" style="font-size: 10px; color: #838383">
                        40%
                      </div>
                    </div>

                    <div class="mt-1">
                      <div class="font-weight-bold" style="font-size: 12px; color: #123C9A">
                        Rp. 98.000.000
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
  name: 'CampaignCardComponent'
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
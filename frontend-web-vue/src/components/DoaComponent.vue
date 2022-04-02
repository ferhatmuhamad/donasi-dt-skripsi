<template>
  <div>
    <div>
      <div class="font-weight-bold" style="color: #838383">Do'a Orang Baik</div>

      <div>
        <div class="wrapper mt-3">
          <div class="card mr-2" style="width: 18rem" v-for="i in 5" :key="i">
            <div class="card-body shadow p-3">
              <div class="row">
                <div class="col text-truncate" style="font-size: 10px">Andri Nur Hidayatulloh</div>
                <div class="col text-right" style="font-size: 8px">20 jam yang lalu</div>
              </div>

              <div class="row mt-3">
                <div class="col text-truncate" style="font-size: 14px">Ya Allah, semoga bermanfaat untuk semua anak-anak yang ada di panti</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DoaComponent",
};
</script>

<style>
</style>
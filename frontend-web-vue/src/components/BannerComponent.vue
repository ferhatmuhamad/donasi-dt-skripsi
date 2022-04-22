<template>
  <div>
    <!-- mobile -->
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none">
      <!-- banner -->
        <div>
          <b-carousel id="carousel-fade" class="m-2" style="text-shadow: 0px 0px 2px #000" fade indicators img-width="1024" img-height="480">
            <b-carousel-slide v-for="index in banners" :key="index.id_banner" :img-src="index.path">
            </b-carousel-slide>
          </b-carousel>
        </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BannerComponent",
  props: {
    banners: Array
  }
}
</script>

<style>
.carousel-item>img {
  border-radius: 10px;
}

.carousel-indicators {
  bottom: -50px;
}

.carousel-indicators li {
  background-color: #c4c4c4;
}

.carousel-indicators > .active {
  background-color: #12569A;
}
</style>
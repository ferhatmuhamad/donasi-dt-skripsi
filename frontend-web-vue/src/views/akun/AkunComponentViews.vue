<template>
  <div>
    <div class="d-block d-sm-block d-md-block d-lg-none d-xl-none" style="margin-top: 70px; margin-bottom: 100px">
      <navbar-top-component></navbar-top-component>
      <navbar-bottom-component></navbar-bottom-component>
      <div class="container">
        <div class="row">
          <div class="col-auto" style="font-size: 50px">
            <!-- <b-icon-circle-fill></b-icon-circle-fill> -->
            <vue-letter-avatar name="Andri" :rounded="true"></vue-letter-avatar>
          </div>
          <div class="col my-auto">
            <div class="d-inline">
              <div class="font-weight-bold">
                Andri Nur Hidayatulloh
              </div>
              <div style="font-size: 12px">
                andribis13@gmail.com
              </div>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div>
              <font-awesome-icon class="color-sekunder" icon="right-from-bracket"></font-awesome-icon>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col">
            <div class="border p-2" style="border-radius: 5px">
              <div class="row p-2">
                <div class="col-auto" style="font-size: 40px">
                  <font-awesome-icon icon="sack-dollar" class="color-sekunder"></font-awesome-icon>
                </div>
                <div class="col my-auto" style="font-size: 14px">
                  <div>Jumlah Donasi Saya</div>
                  <div class="font-weight-bold mt-2">Rp. 120.000</div>
                </div>
                <div class="col-auto my-auto">
                  <b-icon-eye-slash-fill></b-icon-eye-slash-fill>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row mt-4">
          <div class="col">
            <div class="border-top">
              <div class="row mt-3 mb-3 p-1">
                <div class="col-auto my-auto color-sekunder">
                  <b-icon-house-fill></b-icon-house-fill>
                </div>
                <div class="col my-auto">Dashboard</div>
                <div class="col-auto my-auto">
                  <b-icon-chevron-right></b-icon-chevron-right>
                </div>
              </div>
            </div>

            <div class="border-top">
              <div class="row mt-3 mb-3 p-1">
                <div class="col-auto my-auto color-sekunder">
                  <b-icon-house-fill></b-icon-house-fill>
                </div>
                <div class="col my-auto">Profil</div>
                <div class="col-auto my-auto">
                  <b-icon-chevron-right></b-icon-chevron-right>
                </div>
              </div>
            </div>

            <div class="border-top">
              <div class="row mt-3 mb-3 p-1">
                <div class="col-auto my-auto color-sekunder">
                  <b-icon-house-fill></b-icon-house-fill>
                </div>
                <div class="col my-auto">Riwayat Donasi Saya</div>
                <div class="col-auto my-auto">
                  <b-icon-chevron-right></b-icon-chevron-right>
                </div>
              </div>
            </div>

            <div class="border-top">
              <div class="row mt-3 mb-3 p-1">
                <div class="col-auto my-auto color-sekunder">
                  <b-icon-house-fill></b-icon-house-fill>
                </div>
                <div class="col my-auto">Bantuan</div>
                <div class="col-auto my-auto">
                  <b-icon-chevron-right></b-icon-chevron-right>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Vue from "vue";
import NavbarBottomComponent from "../../components/NavbarBottomComponent.vue";
import NavbarTopComponent from "../../components/NavbarTopComponent.vue";
import { library } from "@fortawesome/fontawesome-svg-core";
import { faRightFromBracket, faSackDollar } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
library.add(faSackDollar, faRightFromBracket);
Vue.component("font-awesome-icon", FontAwesomeIcon);

export default {
  components: { NavbarTopComponent, NavbarBottomComponent }
};
</script>

<style></style>
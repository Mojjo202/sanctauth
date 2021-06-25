<template>
  <div class="home col-8 mx-auto py-5 mt-5 ">
    <div class="card">
      <div class= "d-flex justify-content-center">
    <router-link class="nav-item nav-link" to="/msgraph">MS GRAPH</router-link>
    <hr>
    <router-link class="nav-item nav-link" to="/passport">PASSPORT</router-link>
    <hr>
    <router-link class="nav-item nav-link" to="/socialite">SOCIALITE</router-link>
    <hr>
    <router-link class="nav-item nav-link" to="#">SANCTUM</router-link>
      </div>
    <!-- <div class="card">
      <div class="card-body" v-if="user">
        <h3>Hello, {{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>
    </div> -->
    </div>
  </div>
</template>

<script>
import User from "../apis/User";

export default {
  data() {
    return {
      user: null
    };
  },

  mounted() {
    User.auth().then(response => {
      this.user = response.data;
    });
  }
};
</script>

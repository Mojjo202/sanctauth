<template>
  <div class="home col-8 mx-auto py-5 mt-5 ">
    <div class="card">
      <div class= "d-flex justify-content-center">
    <h2>MS GRAPH</h2>
    <hr>
    <h2>Passport</h2>
    <hr>
    <h2>Socialite</h2>
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

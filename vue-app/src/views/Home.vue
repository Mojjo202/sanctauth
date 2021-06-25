<template>
  <div class="home text-center py-5 mt-5">
    <h1>LOGIN SCREENS</h1>
    <hr>
     <div class="home col-8 mx-auto py-5 mt-5 ">
    <div class="card">
      <div class= "d-flex justify-content-center">
    <router-link class="nav-item nav-link" to="/msgraph">MS GRAPH</router-link>
    <hr>
    <router-link class="nav-item nav-link" to="/passport">PASSPORT</router-link>
    <hr>
    <router-link class="nav-item nav-link" to="/socialite">SOCIALITE</router-link>
    <hr>
    <router-link class="nav-item nav-link" to="/login">SANCTUM</router-link>
      </div>
    <!-- <div class="card">
      <div class="card-body" v-if="user">
        <h3>Hello, {{ user.name }}</h3>
        <span>{{ user.email }}</span>
      </div>
    </div> -->
    </div>
  </div>
  </div>
</template>

<script>
export default {
  name: "Home"
};
</script>

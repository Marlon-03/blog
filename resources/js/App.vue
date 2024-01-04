<template>
    <div>
      <Navbar v-if="shouldShowNavbar" @handleLoginClick="handleLoginClick" @handleRegisterClick="handleRegisterClick" />
      <router-view @showNavbar="showNavbar" :key="$route.path"/>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
export default {
    components: {
      Navbar,
    },
    data() {
      return {
        shouldShowNavbar: true,
      };
    },
    methods: {
      handleLoginClick() {
        this.shouldShowNavbar = false;
      },
      handleRegisterClick() {
        this.shouldShowNavbar = false;
      },
      showNavbar() {
        this.shouldShowNavbar = true;
      },
    },
};
</script>
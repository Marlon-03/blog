<template>
    <div>
      <Navbar v-if="shouldShowNavbar" @handleLoginClick="handleLoginClick" @handleRegisterClick="handleRegisterClick" />
      <LanguageSwitcher />
      <router-view @showNavbar="showNavbar" :key="$route.path"/>
    </div>
</template>

<script>
import Navbar from './components/Navbar.vue';
import LanguageSwitcher from './components/LanguageSwitcher.vue';
export default {
    components: {
      Navbar,
      LanguageSwitcher,
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

<style>
</style>
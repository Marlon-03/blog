<template>
  <div v-if="showNavbar">
    <div class="flex justify-around items-center py-4 bg-[#58AB91] lg:flex-row flex-col">
      <div class="flex items-center">
        <img src="../../img/vite.png" alt="Logo" class="h-10 w-10" />
      </div>
      <button @click="isOpen = !isOpen" class="lg:hidden">
        <img :src="hamburgerIcon" class="absolute w-7 h-7 ml-1">
      </button>
      <div v-if="isOpen || isLargeScreen" class="lg:flex hidden space-x-10 text-white font-semibold text-xl">
        <router-link :to="{name: 'Home'}">{{ $t('navbar.home') }}</router-link>
        <router-link :to="{name: 'Blog'}">{{ $t('navbar.blog') }}</router-link>
        <router-link :to="{name: 'About'}">{{ $t('navbar.about') }}</router-link>
        <router-link :to="{name: 'Contact'}">{{ $t('navbar.contact') }}</router-link>
      </div>
      <div v-if="isOpen || isLargeScreen" class="lg:flex hidden space-x-10 text-white font-semibold text-xl">
        <router-link :to="{name: 'Login'}" v-if="!isLoggedIn" @click="handleLoginClick">{{ $t('navbar.login') }}</router-link>
        <router-link :to="{name: 'Register'}" v-if="!isLoggedIn" @click="handleRegisterClick">{{ $t('navbar.register') }}</router-link>
        <router-link :to="{name: 'Dashboard'}" v-if="isLoggedIn">{{ $t('navbar.dashboard') }}</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import hamburgerIcon from '../../../public/img/hamburger.svg';
export default {
  data() {
    return {
      hamburgerIcon,
      isLoggedIn: false,
      isOpen: false,
      isLargeScreen: window.innerWidth > 768,
    };
  },
  computed: {
    showNavbar() {
      return this.$route.name !== 'Login' && this.$route.name !== 'Register';
    }
  },
  created() {
    this.checkAuthentication();
    window.addEventListener('resize', this.updateWindowSize);
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.updateWindowSize);
  },
  watch: {
    '$route': function() {
      this.checkAuthentication();
    },
  },
  methods: {
    handleLoginClick() {
      this.$emit('handleLoginClick');
      this.isOpen = false;
    },
    handleRegisterClick() {
      this.$emit('handleRegisterClick');
      this.isOpen = false;
    },
    checkAuthentication() {
      this.isLoggedIn = !!localStorage.getItem('authenticated');
    },
    updateWindowSize() {
      this.isLargeScreen = window.innerWidth > 768;
    }
  },
};
</script>

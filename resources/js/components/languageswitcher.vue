<template>
    <div>
      <select v-model="selectedLang" @change="changeLanguage">
        <option value="en">English</option>
        <option value="es">Español</option>
      </select>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        selectedLang: this.$i18n.locale
      };
    },
    methods: {
      changeLanguage() {
        this.$i18n.locale = this.selectedLang;
      }
    }
  };
  </script>
<template>
    <div className="flex justify-around items-center py-4 bg-slate-600">
        <div className="flex items-center">
            <img src="../../img/vite.png" alt="Logo" class="h-10 w-auto" />
        </div>
        <div className="space-x-10 text-gray-200">
            <router-link :to="{name: 'Home'}">Home</router-link>
            <router-link :to="{name: 'About'}">About</router-link>
            <router-link :to="{name: 'About'}">About</router-link>  
            <router-link :to="{name: 'Contact'}">Contact</router-link>
            <router-link :to="{name: 'Login'}" @click="handleLoginClick">Log In</router-link>
            <router-link :to="{name: 'Register'}" @click="handleRegisterClick">Register</router-link>
            <router-link :to="{name: 'Dashboard'}">Dashboard</router-link>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
  handleLoginClick() {
    this.$emit('handleLoginClick');
  },
  handleRegisterClick() {
    this.$emit('handleRegisterClick');
  },
},
};
</script>
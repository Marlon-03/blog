<template>
    <div className="flex justify-around items-center py-4 bg-[#58AB91]">
        <div className="flex items-center">
            <img src="../../img/vite.png" alt="Logo" class="h-10 w-auto" />
        </div>
        <div className="space-x-10 text-white font-semibold text-xl">
            <router-link :to="{name: 'Home'}">Home</router-link>
            <router-link :to="{name: 'Blog'}">Blog</router-link>
            <router-link :to="{name: 'About'}">About</router-link>
            <router-link :to="{name: 'Contact'}">Contact</router-link>
        </div>
        <div className="space-x-10 text-white font-semibold text-xl">
            <router-link :to="{name: 'Login'}" v-if="!isLoggedIn" @click="handleLoginClick">Log In</router-link>
            <router-link :to="{name: 'Register'}" v-if="!isLoggedIn" @click="handleRegisterClick">Register</router-link>
            <router-link :to="{name: 'Dashboard'}" v-if="isLoggedIn">Dashboard</router-link>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            isLoggedIn: false,
        };
    },
    created() {
        this.checkAuthentication();
    },
    watch: {
        '$route': function() {
            this.checkAuthentication();
        },
    },
    methods: {
        handleLoginClick() {
            this.$emit('handleLoginClick');
        },
        handleRegisterClick() {
            this.$emit('handleRegisterClick');
        },
        checkAuthentication() {
            this.isLoggedIn = !!localStorage.getItem('authenticated');
        },
    },
};
</script>

<style scoped>

</style>
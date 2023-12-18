<template>
    <!-- navbar -->
    <div className="flex justify-around items-center py-4 bg-slate-600">
        <div className="flex items-center">
            <img src="../img/vite.png" alt="Logo" class="h-10 w-auto" />
        </div>
        <div className="space-x-10 text-gray-200">
            <router-link :to="{name: 'Home'}">Home</router-link>
            <router-link :to="{name: 'About'}">About</router-link>
            <router-link :to="{name: 'About'}">About</router-link>  
            <router-link :to="{name: 'Contact'}">Contact</router-link>
            <router-link :to="{name: 'Login'}" v-if="!loggedIn">Log In</router-link>
            <router-link :to="{name: 'Register'}" v-if="!loggedIn">Register</router-link>
            <router-link :to="{name: 'Dashboard'}" v-if="loggedIn">Dashboard</router-link>
        </div>
    </div>

    <!-- components -->
    <router-view @update-navbar="updateNavbar"/>

    <!-- footer -->
</template>

<script>
export default{
    data(){
        return{
            loggedIn: false
        }  
    },
    methods:{
        updateNavbar(){
            this.loggedIn = !this.loggedIn;
        }
    },
    mounted(){
        if(localStorage.getItem('authenticated')){
            this.loggedIn = true;
        }else{
            this.loggedIn = false;
        }
    }
}
</script>
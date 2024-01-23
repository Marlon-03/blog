<template>
    <div class="relative background flex items-center justify-center h-screen">
    <div class="absolute flex bg-white px-5 py-5">
        <form @submit.prevent="saveData" class="flex flex-col gap-y-3 items-center justify-center">
            <h1 class="font-kadwa font-bold decoration-black text-2xl">Log in</h1>

            <div class="flex">
                <img :src="EmailIcon">
           <input type="email" v-model="user.email" id="email" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" >
            </div>

            <div class="flex">
               <img :src="PasswordIcon">
                <input type="password" v-model="user.password" id="password" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Log In</button>
            <span>Don't have an account?<router-link :to="{name: 'Register'}">Register Here</router-link></span>
        </form>
    </div>
</div>
</template>

<script>
import EmailIcon from '../../../public/img/email.svg';
import PasswordIcon from '../../../public/img/password.svg';
export default {
    emits: ['showNavbar'],
    data(){
        return{
            EmailIcon,
            PasswordIcon,
            user:{
                email: '',
                password: '',
            }
        };
    },
    methods:{
    saveData() {
        return axios.post('/api/login', this.user)
        .then(response => {
    console.log('Response:', response.data);

    // Store the API token in local storage
    localStorage.setItem('apiToken', response.data.api_token);

    // Store the user's role in local storage
    localStorage.setItem('userRole', response.data.role);

    localStorage.setItem('authenticated', true);
    this.$emit('showNavbar') // Emit the event

    // Check the user's role and navigate to the appropriate dashboard
    if (response.data.role === 'admin') {
        this.$router.push({name: 'AdminDashboard'});
    } else if (response.data.role === 'contributor') {
        this.$router.push({name: 'Dashboard'});
    }
})
.catch(error => {
    console.error('Error:', error);
});
    }}
    }
</script>

<style scoped>

.background {
    background-image: url('/img/Background.png');
    background-size: cover;
    background-position: center center;
    min-height: 100vh; 
}

</style>
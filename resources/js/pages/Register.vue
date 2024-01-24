<template>
    <div class="relative background flex items-center justify-center h-screen">
    <div class="absolute flex bg-white px-10 py-10 drop-shadow-lg">
    <form @submit.prevent="registerData" class="flex flex-col gap-y-5 items-center justify-center ">
        <h1 class="font-kadwa font-bold decoration-black text-2xl">Create account</h1>

        <div class="relative flex w-full items-center">
            <img :src="PersonIcon" class="absolute  w-7 h-7 ml-1">
            <input type="text" v-model="user.name" id="name" placeholder="Your name" 
            class="w-full border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
        </div>

        <div class="relative flex w-full items-center">
            <img :src="EmailIcon" class="absolute  w-7 h-7 ml-1">
            <input type="email" v-model="user.email" id="email" placeholder="Your email" 
            class="w-full border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
        </div>

        <div class="relative flex w-full items-center">  
            <img :src="PasswordIcon" class="absolute  w-7 h-7 ml-1">
            <input type="password" v-model="user.password" id="password" placeholder="Password"
            class="w-full border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
        </div>  

        <div class="relative flex w-full items-center"> 
            <img :src="ConfirmIcon" class="absolute  w-7 h-7 ml-1">
            <input type="password" v-model="user.password_confirmation" id="password_confirmation" placeholder="Confirm Password"
            class="w-full border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
        </div>
        <!-- Display validation errors if present -->
        <div v-if="validationErrors" class="error-messages">
            <p v-for="(errors, field) in validationErrors" :key="field">{{ errors.join(', ') }}</p>
        </div>

        <button type="submit" class="bg-[#58AB91] text-white font-bold px-4 py-2 rounded-3xl w-full">Register</button>
        <span>Already have an account?<router-link :to="{ name: 'Login' }">
        <span class="underline text-[#ab5872] font-semibold">Login Here</span></router-link></span>
    </form>
    </div>
    </div>
</template>

<script>
import EmailIcon from '../../../public/img/email.svg';
import PersonIcon from '../../../public/img/person.svg';
import PasswordIcon from '../../../public/img/password.svg';
import ConfirmIcon from '../../../public/img/confirm.svg';
export default {
    emits: ['showNavbar'],
    data() {
        return {
            PersonIcon,
            ConfirmIcon,
            EmailIcon,
            PasswordIcon,
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                role: 'contributor', // default role
            },
            validationErrors: null,
        };
    },
    methods: {
        registerData() {
            this.validationErrors = null;

            axios.post('/api/register', this.user)
                .then(response => {
                    console.log('Response:', response.data);
                    this.$router.push({ name: 'Login' });
                })
                .catch(error => {
                    console.error('Error:', error);

                    if (error.response && error.response.status === 422) {
                        this.validationErrors = error.response.data.errors;
                    }
                });
        },
    },
};
</script>

<style scoped>
.background {
    background-image: url('/img/Background.png');
    background-size: cover;
    background-position: center center;
    min-height: 100vh; /* This makes sure the div takes up the full height of the viewport */
}
</style>
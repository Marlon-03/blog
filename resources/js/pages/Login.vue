<template>
    <div class="relative background flex items-center justify-center h-screen">
    <div class="absolute flex bg-white px-10 py-10 drop-shadow-lg">
        <form @submit.prevent="saveData" class="flex flex-col gap-y-5 items-center justify-center ">
            <h1 class="font-kadwa font-bold decoration-black text-2xl">Log in</h1>

            <div class="relative flex w-full items-center">
                <img :src="EmailIcon" class="absolute  w-7 h-7 ml-1">
                <input type="email" v-model="user.email" id="email" placeholder="Your email" 
                class="w-full border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
            </div>

            <div class="relative flex w-full items-center">
                <img :src="PasswordIcon" class="absolute w-7 h-7 ml-1">
                <input type="password" v-model="user.password" id="password" placeholder="Your password" 
                class="w-full border border-t-0 border-l-0 border-r-0 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
            </div>
            <button type="submit" class="bg-[#58AB91] text-white font-bold px-4 py-2 rounded-3xl w-full">Log In</button>
            <span>Don't have an account?<router-link :to="{name: 'Register'}">
                <span class="underline text-[#ab5872] font-semibold">Register Here</span></router-link></span>
        </form>
    </div>
</div>
</template>

<script>
import Swal from 'sweetalert2';
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

          // Show a success message
          Swal.fire({
            icon: 'success',
            title: 'Logged in successfully',
          });

          // Check the user's role and navigate to the appropriate dashboard
          if (response.data.role === 'admin') {
            this.$router.push({name: 'AdminDashboard'});
          } else if (response.data.role === 'contributor') {
            this.$router.push({name: 'Dashboard'});
          }
        })
        .catch(error => {
          console.error('Error:', error);

          // Show an error message
          Swal.fire({
            icon: 'error',
            title: 'Username or password is incorrect',
          });
        });
    },
  },
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
<template>
    <div class="background">
    <div className="flex mx-auto items-center justify-center h-screen">
        <form @submit.prevent="saveData" className="flex flex-col">
            <label className="block text-gray-600 text-sm font-medium mb-2">Email</label>
            <input type="email" v-model="user.email" id="email" className="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" >

            <label className="block text-gray-600 text-sm font-medium mb-2">Password</label>
            <input type="password" v-model="user.password" id="password" className="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500">
            
            <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Log In</button>
            <span>Don't have an account?<router-link :to="{name: 'Register'}">Register Here</router-link></span>
        </form>
    </div>
</div>
</template>

<script>
export default {
    emits: ['showNavbar'],
    data(){
        return{
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
    min-height: 100vh; /* This makes sure the div takes up the full height of the viewport */
}
</style>
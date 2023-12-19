<template>
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
            axios.post('/api/login', this.user)
                .then(response => {
                    console.log('Response:', response.data);
                    this.$router.push({name: 'Dashboard'});
                    localStorage.setItem('authenticated', true);
                    this.$emit('showNavbar') // Emit the event
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        },
    }
}
</script>

<style scoped>
/* div{
    width:400px;
    height:500px;
} */
</style>
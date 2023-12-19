<template>
    <form @submit.prevent="saveData">
        <label>Email</label>
        <input type="email" v-model="user.email" id="email">

        <label>Password</label>
        <input type="password" v-model="user.password" id="password">
        
        <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Log In</button>
        <span>Don't have an account?<router-link :to="{name: 'Register'}">Register Here</router-link></span>
    </form>
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
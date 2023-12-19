<template>
    <div className="flex mx-auto items-center justify-center h-screen">
    <form @submit.prevent="registerData" className="flex flex-col">
        <label className="block text-gray-600 text-sm font-medium mb-2">Name</label>
        <input type="text" v-model="user.name" id="name" className="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" >

        <label className="block text-gray-600 text-sm font-medium mb-2">Email</label>
        <input type="email" v-model="user.email" id="email" className="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" >

        <label className="block text-gray-600 text-sm font-medium mb-2">Password</label>
        <input type="password" v-model="user.password" id="password" className="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" >

        <label className="block text-gray-600 text-sm font-medium mb-2">Confirm Password</label>
        <input type="password" v-model="user.password_confirmation" id="password_confirmation" className="w-full border border-gray-300 p-2 rounded focus:outline-none focus:border-blue-500" >

        <!-- Display validation errors if present -->
        <div v-if="validationErrors" class="error-messages">
            <p v-for="(errors, field) in validationErrors" :key="field">{{ errors.join(', ') }}</p>
        </div>

        <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Register</button>
        <span>Already have an account?<router-link :to="{ name: 'Login' }">Log In Here</router-link></span>
    </form>
    </div>
</template>

<script>
export default {
    emits: ['showNavbar'],
    data() {
        return {
            user: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
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
                    this.$router.push({ name: 'Dashboard' });
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
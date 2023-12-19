<template>
    <form @submit.prevent="registerData">
        <label>Name</label>
        <input type="text" v-model="user.name" id="name">

        <label>Email</label>
        <input type="email" v-model="user.email" id="email">

        <label>Password</label>
        <input type="password" v-model="user.password" id="password">

        <label>Confirm Password</label>
        <input type="password" v-model="user.password_confirmation" id="password_confirmation">

        <!-- Display validation errors if present -->
        <div v-if="validationErrors" class="error-messages">
            <p v-for="(errors, field) in validationErrors" :key="field">{{ errors.join(', ') }}</p>
        </div>

        <button type="submit">Register</button>
        <span>Already have an account?<router-link :to="{ name: 'Login' }">Log In Here</router-link></span>
    </form>

    <!-- Display user data for testing -->
    <h1>{{ user.name }}</h1>
    <h1>{{ user.email }}</h1>
    <h1>{{ user.password }}</h1>
    <h1>{{ user.password_confirmation }}</h1>
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
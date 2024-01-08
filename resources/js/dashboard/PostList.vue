<template>
    <h1>Posts List</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.title }}</td>
                <td>{{ post.category.name }}</td>
                <td>{{ post.created_at }}</td>
                <td>
                    <router-link :to="{name: 'EditPosts', params: {slug: post.slug}}">Edit</router-link>
                    <button @click="deletePost(post.id)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import axios from 'axios';

export default {
    emits: ['showNavbar'], 
    data() {
        return {
            posts: [],
        };
    },

    mounted() {
        axios.get('/api/dashboard-posts')
        .then((response) => {
            this.posts = response.data.data;
        }).catch((error) => {
            console.log(error);
        });
    },

    methods: {
        deletePost(id) {
            axios.delete('/api/posts/' + id)
            .then((response) => {
                this.posts = this.posts.filter((post) => post.id !== id);
            }).catch((error) => {
                console.log(error);
            });
        }
    }
}
</script>
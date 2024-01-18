<template>
    <h1>Posts List</h1>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="post in posts" :key="post.id">
                <td>{{ post.title }}</td>
                <td>{{ post.category.name }}</td>
                <td>{{ post.created_at }}</td>
                <td>{{ getStatusText(post.status) }}</td>
                <td>
                    <router-link :to="{name: 'EditPosts', params: {slug: post.slug}}">Edit</router-link>
                    <button @click="destroy(post.slug)">Delete</button>
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
       this.fetchPosts();
    },

    methods: {
        destroy(slug){
            axios.delete('/api/posts/' + slug)
            .then((response) => {
                this.fetchPosts();
                console.log(response);
                console.log('Post deleted successfully');
                this.$router.push({name: 'PostsList'});
            }).catch((error) => {
                console.log(error);
            });
        },

        getStatusText(status) {
            status = parseInt(status, 10);
                switch (status) {
                    case 0: return 'Disapproved';
                    case 1: return 'Pending';
                    case 2: return 'Approved';
                    default: return 'Unknown';
                }
        },

        fetchPosts(){
            axios.get('/api/dashboard-posts')
        .then((response) => {
            this.posts = response.data.data;
            console.log(this.posts);
        }).catch((error) => {
            console.log(error);
        });
        }
    }
}
</script>
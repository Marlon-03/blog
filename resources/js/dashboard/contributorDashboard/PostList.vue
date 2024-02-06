<template>
    <div class=" px-10 py-10">
    <table class="table-fixed w-full">
        <thead>
            <tr>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Created At</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(post, index) in posts" :key="post.id" :class="index % 2 ? 'bg-green-100' : 'bg-white'" class="text-center">
                <td class="border px-4 py-2">{{ post.title }}</td>
                <td class="border px-4 py-2">{{ post.category.name }}</td>
                <td class="border px-4 py-2">{{ post.created_at }}</td>
                <td class="border px-4 py-2">
                    <span class="px-2" :class="{'bg-red-300': post.status === 0, 'bg-yellow-300': post.status === 1, 'bg-green-500': post.status === 2}">
                        {{ getStatusText(post.status) }}
                    </span>
                </td>
                <td class="border px-4 py-2">
                    <div class="gap-2 flex justify-center">
                    <router-link :to="{name: 'EditPosts', params: {slug: post.slug}}" class="bg-yellow-500 px-2 py-2 rounded-md">Edit</router-link>
                    <button @click="destroy(post.slug)" class="bg-red-500 px-2 py-2 rounded-md">Delete</button>
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
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
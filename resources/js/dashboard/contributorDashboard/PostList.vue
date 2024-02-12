<template>
<div class="bg-[#F2F1E9] h-screen flex justify-center items-center">
    <div class=" px-10 py-10">
    <table class="table-fixed w-full bg-white">
        <thead>
            <tr>
                <th class="border px-2 py-2">Title</th>
                <th class="border px-2 py-2 sm:table-cell hidden">Category</th>
                <th class="border px-2 py-2 sm:table-cell hidden">Created At</th>
                <th class="border px-2 py-2">Status</th>
                <th class="border px-2 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(post, index) in posts" :key="post.id" :class="index % 2 ? 'bg-green-100' : 'bg-white'" class="text-center">
                <td class="border px-2 py-2">{{ post.title }}</td>
                <td class="border px-2 py-2 sm:table-cell hidden">{{ post.category.name }}</td>
                <td class="border px-2 py-2 sm:table-cell hidden">{{ post.created_at }}</td>
                <td class="border px-1 md:px-2 py-2 text-xs md:text-sm">
                    <span class="px-2" :class="{'bg-red-300': post.status === 0, 'bg-yellow-300': post.status === 1, 'bg-green-500': post.status === 2}">
                        {{ getStatusText(post.status) }}
                    </span>
                </td>
                <td class="border px-2 py-2">
                    <div class="gap-2 flex justify-center">
                    <router-link :to="{name: 'EditPosts', params: {slug: post.slug}}" class="bg-yellow-500 text-xs md:text-sm md:px-2 md:px-2 px-1 py-1 text-center rounded-md">Edit</router-link>
                    <button @click="destroy(post.slug)" class="bg-red-500 text-xs md:text-sm md:px-2 md:px-2 px-1 py-1 rounded-md">Delete</button>
                </div>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
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
        destroy(slug) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                axios.delete('/api/posts/' + slug)
                .then((response) => {
                    // Show a success message with SweetAlert2
                    Swal.fire({
                    title: "Deleted!",
                    text: "Your post has been deleted.",
                    icon: "success"
                    });

                    this.fetchPosts();
                    this.$router.push({name: 'PostsList'});
                }).catch((error) => {
                    console.log(error);

                    // Show an error message with SweetAlert2
                    Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while deleting the post',
                    });
                });
                }
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
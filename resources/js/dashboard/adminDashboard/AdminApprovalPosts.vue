<template>
      <div class="bg-[#F2F1E9] h-screen">
    <div class=" px-10 py-10">
    <table class="table-fixed w-full bg-white">
        <thead>
            <tr>
                <th class="border px-4 py-2">Title</th>
                <th class="border px-4 py-2">Category</th>
                <th class="border px-4 py-2">Created At</th>
                <th class="border px-4 py-2">Status</th>
                <th class="border px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(post, index) in posts" :key="post.id" :class="index % 2 ? 'bg-green-100' : 'bg-white'" class="text-center">
                <td class="border px-4 py-2">{{ post.title }}</td>
                <td class="border px-4 py-2">{{ post.category.name }}</td>
                <td class="border px-4 py-2">{{ post.created_at }}</td>
                <td class="border px-4 py-2">
                    <select @change="updatePostStatus(post.id, $event.target.value)" :class="{'bg-red-300': post.status === 0, 'bg-yellow-300': post.status === 1, 'bg-green-500': post.status === 2}">
                        <option value="0" :selected="post.status === 0">Disapproved</option>
                        <option value="1" :selected="post.status === 1">Pending</option>
                        <option value="2" :selected="post.status === 2">Approved</option>
                    </select>
                </td>
                <td class="border px-4 py-2">
                    <button @click="destroy(post.slug)" class="bg-red-500 px-2 py-2 rounded-md">Delete</button>
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

    created() {
       this. fetchAdminApprovalPosts();
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
                    case 0: return 'Your request has been disapproved.';
                    case 1: return 'Your request is pending.';
                    case 2: return 'Your request has been approved.';
                    default: return 'Unknown';
                }
        },

        fetchAdminApprovalPosts() {
        axios.get('/api/admin/posts')
            .then((response) => {
                this.posts = response.data.data;
                console.log(this.post)
            })
            .catch((error) => {
                console.log(error);
            });
    },
    
    updatePostStatus(postId, status) {
    axios.put(`/api/admin/posts/${postId}/status`, { status })
        .then(() => {
            this.fetchAdminApprovalPosts();  // Refresh the post list
            console.log(this.getStatusText(status));  // Log the status message
        })
        .catch((error) => {
            if (error.response && error.response.status === 422) {
                console.error('Invalid status. Status must be 0, 1, or 2.');
            } else {
                console.error(error);
            }
        });
},
    }
}
</script>
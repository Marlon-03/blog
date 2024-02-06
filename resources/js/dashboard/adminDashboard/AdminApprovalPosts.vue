<template>
    <h1>Admin Approval Post</h1>
    <table class="table-fixed">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
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
                <td>
    <select @change="updatePostStatus(post.id, $event.target.value)">
        <option value="0" :selected="post.status === 0">Disapproved</option>
        <option value="1" :selected="post.status === 1">Pending</option>
        <option value="2" :selected="post.status === 2">Approved</option>

    </select>
</td>
                <td>
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
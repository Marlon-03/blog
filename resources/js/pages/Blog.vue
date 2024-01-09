<template>
    <h1>this is blog page</h1>
    <div class="categories">
        <ul>
            <li v-for="category in categories" :key="category.id">
                <a href="#" @click="filterByCategory(category.name)">{{ category.name }}</a>

            </li>
        </ul>
    </div>
    <section class="cards-blog latest-blog">
        <div class="card-blog-content" v-for="post in posts" :key="post.id">
            <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image">
            <p>
            {{ post.created_at }}
            <span>Written by{{ post.user }}</span>
            </p>
            <h4>

                <router-link :to="{name: 'SingleBlog', params: {slug: post.slug},}">{{ post.title }}</router-link>
            </h4>
        </div>

    </section>
</template>

<script>
import axios from 'axios';

export default{
    emits: ['showNavbar'], 
    data(){
        return{
            posts: [],
            categories: [],
        };
    },

    methods: {
        filterByCategory(name){
            axios.get('api/posts', {
                params: {
                    category:name,
                },
            })
            .then((response) => {
                this.posts = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
        }
    },

    mounted(){
        axios.get('/api/posts')
        .then((response) => {
            this.posts = response.data.data;
        }).catch((error) => {
            console.log(error);
        });

        axios.get('/api/categories')
        .then((response) => {
            this.categories = response.data;
        }).catch((error) => {
            console.log(error);
        });
    }
    }
</script> 
<template>
    <div>
        <!-- Greeting Section -->
        <div class="flex justify-between items-center px-5 md:px-20 py-5">
            <h1 class="font-kadwa font-medium text-xl">{{ $t('dashboard.greeting', { name }) }}</h1>
            <button @click="logout" class="font-kadwa font-medium text-xl bg-[#D9D9D9] px-3 py-2 rounded-md">
                {{ $t('dashboard.logout') }}
            </button>
        </div>

        <div class="line-2 h-px bg-black mt-1.5"></div>

        <!-- Main Content -->
        <div class="bg-[#F2F1E9] h-screen">
            <div class="md:grid md:grid-cols-3 flex flex-col px-5 gap-5 lg:gap-5 xl:gap-7 justify-items-center pt-10">
                <router-link
                    class="bg-[#58AB91] rounded-md md:min-w-[200px] lg:min-h-[90px] lg:min-w-[250px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"
                    :to="{ name: 'CreatePost' }"
                >
                    <div class="justify-center items-center flex-col flex px-4 py-8">
                        <img :src="writeIcon" class="w-10 h-10" />
                        <p class="font-istok-web font-bold text-white text-2xl">{{ $t('dashboard.writePost') }}</p>
                    </div>
                </router-link>

                <router-link
                    class="bg-[#58AB91] rounded-md md:min-w-[200px] lg:min-h-[90px] lg:min-w-[250px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"
                    :to="{ name: 'ContributorCategoriesList' }"
                >
                    <div class="justify-center items-center flex-col flex px-4 py-8">
                        <img :src="notesIcon" class="w-10 h-10" />
                        <p class="font-istok-web font-bold text-white text-2xl">{{ $t('dashboard.categoriesList') }}</p>
                    </div>
                </router-link>

                <router-link
                    class="bg-[#58AB91] rounded-md md:min-w-[200px] lg:min-h-[90px] lg:min-w-[250px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"
                    :to="{ name: 'PostsList' }"
                >
                    <div class="justify-center items-center flex-col flex px-4 py-8">
                        <p class="font-istok-web font-bold text-white text-4xl">{{ postCount }}</p>
                        <p class="font-istok-web font-bold text-white text-2xl">{{ $t('dashboard.yourPosts') }}</p>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>


<script>
import writeIcon from '../../../public/img/write.svg';
import notesIcon from '../../../public/img/notes.svg';

export default {
    emits: ['showNavbar'], 
    data() {
        return {
            name: '',
            writeIcon,
            notesIcon,
            postCount: 0,
        };
    },
    mounted() {
        const apiToken = localStorage.getItem('apiToken');

        axios.get('/api/user', {
            headers: {
                'Authorization': `Bearer ${apiToken}`,
            },
        })
        .then((response) => {
            this.name = response.data.name;
        })
        .catch((error) => {
            console.log(error);
        });
    },
    created() {
        this.fetchPostCount();
    },
    methods: {
        logout() {
            axios.post('/api/logout')
                .then(() => {
                    this.$router.push({ name: 'Home' });
                    localStorage.removeItem('authenticated');
                    this.$emit('showNavbar');
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        fetchPostCount() {
            axios.get('/api/posts/count')
                .then((response) => {
                    this.postCount = response.data.count;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>
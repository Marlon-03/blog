<template>
    <div class="relative background flex items-center justify-center h-3/4">
        <div class=" flex flex-col gap-y-36">
            <div class="hero-content flex flex-col gap-y-5 items-center text-white">
                <h1 class="font-kadwa xl:text-8xl text-5xl md:text-6xl lg:text-6xl">All About Me</h1>
            </div>
        </div>
    </div>

    <div class="bg-[#F2F1E9] w-full py-20 px-10">
        <div class="tabs w-full flex flex-col justify-center text-center md:flex-row gap-5 pb-8">
            <div class="tab font-kadwa font-semibold text-3xl" 
                 v-for="(tab, index) in tabs" 
                 :key="index" 
                 @click="activeTab = tab"
                 :class="{ active: activeTab === tab }">
                {{ tab }}
            </div>
        </div>

        <div class="tab-content bg-white  rounded-md px-5 py-5">
            <div v-if="activeTab === 'My Story'" class="flex justify-between gap-5 flex-col md:flex-row ">
                <div class="md:w-[35%] w-[100%]">
                    <img src="../../../public/img/king.jpg"
                    class="w-96 h-80 object-cover"/>
                </div>
                <div class="md:w-[55%] w-[100%]">
                    <p class="text-lg font-istok-web indent">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus vel magni enim eligendi, 
                        dolorem id fugit asperiores, distinctio praesentium voluptate ad modi unde et fugiat saepe 
                        perspiciatis nemo. Asperiores ex ut voluptate. Illum mollitia nobis cum suscipit id fuga autem.<br>
                    </p>
                    <p class="text-lg font-istok-web indent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga distinctio fugiat eos, tempora explicabo nobis.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga distinctio fugiat eos, tempora explicabo nobis. 
                        Iusto ipsum fugit accusantium inventore voluptatibus, laborum odit, doloremque cupiditate ea maxime, totam molestiae laboriosam.
                    </p>
                </div>
            </div>
            <div v-if="activeTab === 'Experience'" class="flex justify-between gap-5 flex-col md:flex-row ">
                <div class="md:w-[35%] w-[100%]">
                    <img src="../../../public/img/rook.jpeg"
                    class="w-96 h-80 object-cover"/>
                </div>
                <div class="md:w-[55%] w-[100%]">
                    <p class="text-lg font-istok-web indent">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus vel magni enim eligendi, 
                        dolorem id fugit asperiores, distinctio praesentium voluptate ad modi unde et fugiat saepe 
                        perspiciatis nemo. Asperiores ex ut voluptate. Illum mollitia nobis cum suscipit id fuga autem.<br>
                    </p>
                    <p class="text-lg font-istok-web indent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga distinctio fugiat eos, tempora explicabo nobis.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga distinctio fugiat eos, tempora explicabo nobis. 
                        Iusto ipsum fugit accusantium inventore voluptatibus, laborum odit, doloremque cupiditate ea maxime, totam molestiae laboriosam.
                    </p>
                </div>
            </div>
            <div v-if="activeTab === 'Education'" class="flex justify-between gap-5 flex-col md:flex-row ">
                <div class="md:w-[35%] w-[100%]">
                    <img src="../../../public/img/knight.jpeg"
                    class="w-96 h-80 object-cover"/>
                </div>
                <div class="md:w-[55%] w-[100%]">
                    <p class="text-lg font-istok-web indent">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus vel magni enim eligendi, 
                        dolorem id fugit asperiores, distinctio praesentium voluptate ad modi unde et fugiat saepe 
                        perspiciatis nemo. Asperiores ex ut voluptate. Illum mollitia nobis cum suscipit id fuga autem.<br>
                    </p>
                    <p class="text-lg font-istok-web indent">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga distinctio fugiat eos, tempora explicabo nobis.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga distinctio fugiat eos, tempora explicabo nobis. 
                        Iusto ipsum fugit accusantium inventore voluptatibus, laborum odit, doloremque cupiditate ea maxime, totam molestiae laboriosam.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center pt-10">
            <!-- change the path to your cv -->
            <a href="../../../public/img/king.jpg" download class="btn-download text-semibold">Portfolio</a>
            <router-link :to="{name:'Contact'}" class="btn-contact">Contact Me</router-link>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            tabs: ['My Story', 'Experience', 'Education'],
            activeTab: 'My Story'
        }
    }
}
</script>

<style scoped>
.background {
    background-image: url('/public/img/bike.jpg');
    background-size: cover;
    background-position: center center;
    min-height: 50vh; 
}

.tab {
    cursor: pointer;
    padding: 10px;
}
.tab.active {
    border-bottom: 2px solid #58AB91;
}
.indent {
    text-indent: 2em;
}

.btn-download {
    padding: 10px 20px;
    background-color: #58AB91;
    color: white;
    text-decoration: none;
    border-radius: 30px;
    margin-right: 30px;
}

.btn-contact {
    padding: 10px 20px;
    background-color: #AB5872;
    color: white;
    text-decoration: none;
    border-radius: 30px;
}
</style>

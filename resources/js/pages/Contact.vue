<template>
    <div class="relative background flex items-center justify-center h-3/4">
        <div class=" flex flex-col gap-y-36">
            <div class="hero-content flex flex-col gap-y-5 items-center text-white">
                <h1 class="font-kadwa text-8xl">Get in Touch</h1>
            </div>
        </div>
    </div>

    <div class="bg-[#F2F1E9] w-full py-20 px-20">
        <div class="tab-content bg-white rounded-md px-10 py-10">
            <div class="flex gap-5">
                <div class="w-[50%] flex flex-col">
                    <input type="text" placeholder="Name" class="border border-1 rounded-3xl border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="email" placeholder="Email" class="border border-1 rounded-3xl border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="text" placeholder="Subject" class="border border-1 rounded-3xl border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="description" placeholder="Message" class="border border-1 rounded-3xl border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                </div>

                <div class="w-[50%]">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni, beatae voluptatibus. Quo quod provident, nam eius expedita dignissimos ad sunt aliquid pariatur velit accusamus saepe suscipit consequatur voluptatum cupiditate quos ipsa necessitatibus atque illum obcaecati? Corporis minima odit fugiat impedit.</p>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
</script>

<style scoped>
.background {
    background-image: url('/public/img/bike.jpg');
    background-size: cover;
    background-position: center center;
    min-height: 50vh; 
}
</style>
d
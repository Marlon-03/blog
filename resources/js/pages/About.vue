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
            <div v-if="activeTab === 'My Story'" class="flex justify-center items-center gap-5 flex-col md:flex-row p-5">
                <div class="md:w-[35%] w-[100%]">
                    <img src="../../../public/img/aboutBanner.png"
                    class="w-96 h-80 object-cover"/>
                </div>
                <div class="md:w-[55%] w-[100%]">
                    <h4 class="font-semibold text-xl font-istok-web text-start">Hi, I'm Marlon, a passionate web developer whose hobby turned into a career. Coding is not just a job for me; it's a habit that has naturally become my profession. Outside of work, I unwind by playing online games, which helps me relax and stay sharp. I'm also an avid cyclist, using my bike to explore new places and enjoy the outdoors. Additionally, I play chess online, a pastime that hones my strategic thinking and parallels the problem-solving skills I use in web development. This blend of interests and my career in technology reflects my love for continuous learning and embracing challenges, both professionally and personally.</h4>
            
                </div>
            </div>
            <div v-if="activeTab === 'Experience'" class="flex justify-center items-center gap-5 flex-col md:flex-row p-5">
                <div class="md:w-[35%] w-[100%]">
                    <img src="../../../public/img/aboutBanner.png"
                    class="w-96 h-80 object-cover"/>
                </div>
                <div class="md:w-[55%] w-[100%]">
                    <div class="flex items-center flex-wrap mb-4">
                    <h3 class="text-lg md:text-xl font-bold ">
                    IFormatLogicITSolutions 
                    <span class="block sm:inline"> (Full Stack Developer)</span>
                    </h3>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text-start">Utilized the Mailchimp API to automate the email marketing process, increasing productivity by 40%
                        and reducing manual emailing efforts.</p>
                    </li>
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text-start">Incorporated Stripe API and PayPal API to create smooth and secure payment gateways, enhancing
                        user payment experience and ensuring seamless transactions, leading to a 30% increase in successful
                        payments.</p>
                    </li>
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text start">Actively collaborating with other web dev members to design and implement website features</p>
                    </li>
                </ul>

                <div class="flex items-center mt-10 mb-4">
                    <h3 class="text-lg md:text-xl font-bold">Freelance (Full Stack Developer)</h3>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text-start">Effectively employed WordPress, Laravel, Vue.js, and Figma to develop dynamic websites and web
                        applications, ensuring seamless user experiences across diverse projects.</p>
                    </li>
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text-start">Led the effort to enhance the website's speed and accessibility, driving the performance to achieve a
                        faster load time and improved user experience.</p>
                    </li>
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text start">Utilized HTML5, CSS3, and JavaScript to create responsive and visually appealing user interfaces.</p>
                    </li>
                </ul>
                </div>
            </div>
            <div v-if="activeTab === 'Education'" class="flex justify-center items-center gap-5 flex-col md:flex-row p-5">
                <div class="md:w-[35%] w-[100%]">
                    <img src="../../../public/img/aboutBanner.png"
                    class="w-96 h-80 object-cover"/>
                    </div>
                    <div class="md:w-[55%] w-[100%]">
                        <div class="flex items-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#6366f1] mr-2" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z" />
                    </svg>
                    <h3 class="text-xl font-bold ">Tertiary</h3>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class="text-start">President Ramon Magsaysay State University</p>
                    </li>
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class="text-start">(Bachelor of Science in Computer Engineering)</p>
                    </li>
                </ul>

                <div class="flex items-center mb-4 mt-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#6366f1] mr-2" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z" />
                    </svg>
                    <h3 class="text-xl font-bold ">Secondary</h3>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text-start">Guisguis National High School</p>
                    </li>
                </ul>

                <div class="flex items-center mb-4 mt-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#6366f1] mr-2" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m5.825 21l1.625-7.025L2 9.25l7.2-.625L12 2l2.8 6.625l7.2.625l-5.45 4.725L18.175 21L12 17.275z" />
                    </svg>
                    <h3 class="text-xl font-bold ">Primary</h3>
                </div>

                <ul class="space-y-3">
                    <li class="flex items-center pl-6">
                    <span class="w-2.5 h-2.5 flex-shrink-0 rounded-full bg-gradient-to-r from-[#6366f1] to-[#a855f7] mr-3"></span>
                    <p class=" text-start">Guisguis Elementary School</p>
                    </li>
                </ul>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center pt-10">
            <!-- change the path to your cv -->
            <a href="https://marlon-03.github.io/" target="_blank" class="btn-download text-semibold">Portfolio</a>
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
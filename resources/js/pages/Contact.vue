<template>
    <div class="relative background flex items-center justify-center h-3/4">
        <div class=" flex flex-col gap-y-36">
            <div class="hero-content flex flex-col gap-y-5 items-center text-white">
                <h1 class="font-kadwa text-8xl">Get in Touch</h1>
            </div>
        </div>
    </div>

    <div class="bg-[#F2F1E9] w-full py-20 px-24">
        <div class="tab-content px-10 py-10">
            <div class="flex gap-20">
                <div class="w-[50%] flex flex-col bg-white gap-y-5 px-10 py-5 rounded-lg">
                    <input type="text" placeholder="Name" class="border border-1 rounded-lg border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="email" placeholder="Email" class="border border-1 rounded-lg border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="text" placeholder="Subject" class="border border-1 rounded-lg border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="description" placeholder="Message" class="border border-1 rounded-lg border-gray-300 p-2 pl-3 focus:outline-none focus:border-[#58AB91]"/>
                    <input type="submit" value="Send" class="bg-[#58AB92] text-white font-semibold rounded-lg p-2 cursor-pointer"/>
                </div>

                <div class="w-[50%] bg-[#58AB91] rounded-lg px-10 py-5 text-white flex flex-col  gap-y-2">
                    <div>
                        <h2 class="text-center font-kadwa text-lg ">Contact Information</h2>
                        <p class="font-medium">I love to hear from you guys, so whatever the topic might be, please feel free to drop me a line.</p>
                    </div>

                    <div class="relative flex w-full items-center">
                        <img :src="emailIcon" class="absolute w-7 h-7 ml-1">
                        <p class="p-2 pl-10 font-medium">marlonmovilla23@gmail.com</p>
                    </div>

                    <div class="relative flex w-full items-center">
                        <img :src="phoneIcon" class="absolute w-7 h-7 ml-1">
                        <p class="p-2 pl-10 font-medium">+639 128 583 431</p>
                    </div>

                    <div class="relative flex w-full items-center">
                        <img :src="locationIcon" class="absolute w-7 h-7 ml-1">
                        <p class="p-2 pl-10 font-medium">Sta. Cruz, Zambales Philippines</p>
                    </div>

                    <div class="flex items-cente gap-3">
                        <a href="https://www.facebook.com/yourusername" target="_blank">
                            <img :src="facebookIcon" class="w-9 h-9 ml-1">
                        </a>
                        <a href="https://www.linkedin.com/in/yourusername" target="_blank">
                            <img :src="instagramIcon" class="w-9 h-9 ml-1">
                        </a>
                        <a href="https://www.twitter.com/yourusername" target="_blank">
                            <img :src="githubIcon" class="w-9 h-9 ml-1">
                        </a>
                        <a href="https://www.linkedin.com/in/yourusername" target="_blank">
                            <img :src="linkedinIcon" class="w-9 h-9 ml-1">
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import phoneIcon from '../../../public/img/phone.svg';
import emailIcon from '../../../public/img/emailIcon.svg';
import locationIcon from '../../../public/img/location.svg';
import facebookIcon from '../../../public/img/fb.svg';
import instagramIcon from '../../../public/img/ig.svg';
import linkedinIcon from '../../../public/img/linkedin.svg';
import githubIcon from '../../../public/img/github.svg';
export default {
    data(){
        return{
            phoneIcon,
            emailIcon,
            locationIcon,
            facebookIcon,
            instagramIcon,
            linkedinIcon,
            githubIcon
        };
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
</style>
d
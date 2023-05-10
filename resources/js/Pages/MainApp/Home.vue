<script setup>
import { router, usePage } from "@inertiajs/vue3";
import Button from "../../Components/shared/Button.vue";

const list = [
    "Anonymous Sharing",
    "Inspire and Be Inspired",
    "Get daily emails at 12pm (EAT)*",
];

const callToAction = () => {
    if (usePage().props.auth.loggedIn) {
        router.visit("/journal");
    } else {
        router.visit("/register");
    }
};
</script>

<template>
    <div class="w-full h-screen py-32 flex flex-row">
        <div
            class="md:w-full w-1/2 h-full flex flex-col justify-center items-center relative"
        >
            <p class="font-familjen-grotesk text-2xl">
                Welcome to the platform. Here, you can share journal entries
                anonymously with others.
            </p>

            <ul class="w-full mt-3">
                <li v-for="item in list" class="font-familjen-grotesk text-lg">
                    ✓ {{ item }}
                </li>
            </ul>

            <div class="w-full mt-5">
                <Button
                    type="button"
                    class=""
                    option="rounded"
                    label="Get started"
                    backgroundColor="var(--appColor-black)"
                    color="var(--appColor-light)"
                    border="1px solid var(--appColor-light)"
                    @clicked="callToAction()"
                />
            </div>

            <p class="font-familjen-grotesk absolute -bottom-28">
                *only users who share an entry 24hrs from yesterday at 12pm
                (EAT) get to see the previous day's entries
            </p>
        </div>

        <div
            class="md:hidden w-1/2 h-full flex flex-col justify-center relative"
        >
            <!-- <div class="w-full h-1/2 appBgColorBlack absolute -right-10"></div> -->

            <div class="w-4/5 h-5/6 absolute z-20 right-10 rounded-lg overflow-hidden">
                <img
                    src="../../../img/auth_bg.webp"
                    alt="landing page image"
                    class="maintainRatio"
                />
            </div>
        </div>
    </div>
</template>

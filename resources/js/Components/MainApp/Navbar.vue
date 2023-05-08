<script setup>
import { Link } from "@inertiajs/vue3";
import Button from "../shared/Button.vue";

const nav_menu = [
    { title: "Random Entries", to: "/journal/random" },
    { title: "My Entries", to: "/journal/my-journal" },
];

const closeMobileNav = () => {
    document.getElementById("active").checked = false;
};

const toAuthPage = (value) => {
    window.location.href = value;
};
</script>

<template>
    <nav class="w-full absolute top-0 z-30 flex flex-row justify-center">
        <!-- Wide screen nav -->
        <div
            class="md:hidden w-full max-w-[1536px] px-10 py-5 flex flex-row justify-between items-center"
        >
            <!-- Logo -->
            <div class="relative">
                <h1 class="font-familjen-grotesk text-2xl font-semibold italic">
                    RandomJournal
                </h1>
                <a class="w-full h-full absolute top-0" href="/"></a>
            </div>

            <!-- Links -->
            <div id="navMenu" class="flex flex-row items-center">
                <Link
                    v-for="item in nav_menu"
                    :key="item.to"
                    class="capitalize mx-3"
                    :href="item.to"
                >
                    {{ item.title }}
                </Link>
            </div>

            <div class="flex flex-row items-center">
                <Link href="/login">
                    <Button
                        type="button"
                        class="ml-3"
                        option="rounded"
                        label="Sign In"
                        backgroundColor="var(--appColor-light)"
                        color="var(--appColor-black)"
                        border="1px solid var(--appColor-black)"
                    />
                </Link>

                <Link href="/register">
                    <Button
                        type="button"
                        class="ml-3"
                        option="rounded"
                        label="Sign Up"
                        backgroundColor="var(--appColor-black)"
                        color="var(--appColor-light)"
                        border="1px solid var(--appColor-light)"
                    />
                </Link>
            </div>
        </div>

        <!-- smaller screen/mobile nav -->
        <div class="md-min:hidden w-full p-5 flex flex-row justify-between">
            <!-- Logo -->
            <div class="relative">
                <h1 class="font-familjen-grotesk text-2xl font-semibold italic">
                    RandomJournal
                </h1>
                <a class="w-full h-full absolute top-0" href="/"></a>
            </div>

            <input type="checkbox" id="active" />
            <label for="active" class="menu-btn"><span></span></label>
            <label for="active" class="close"></label>

            <div class="wrapper">
                <div
                    class="w-full h-full p-5 flex flex-col justify-center capitalize"
                >
                    <div
                        v-for="item in nav_menu"
                        :key="item.to"
                        class="w-full my-3 text-lg"
                    >
                        <Link
                            class="capitalize my-3"
                            :href="item.to"
                            @click="closeMobileNav"
                        >
                            {{ item.title }}
                        </Link>
                    </div>

                    <div class="mt-10 flex flex-row">
                        <div>
                            <Button
                                type="button"
                                class=""
                                option="rounded"
                                label="Sign In"
                                backgroundColor="var(--appColor-light)"
                                color="var(--appColor-black)"
                                border="1px solid var(--appColor-black)"
                            />
                        </div>

                        <div class="ml-3">
                            <Button
                                type="button"
                                class=""
                                option="rounded"
                                label="Sign Up"
                                backgroundColor="var(--appColor-black)"
                                color="var(--appColor-light)"
                                border="1px solid var(--appColor-light)"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</template>

<style scoped>
nav {
    transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
}

/* mobile nav */
.wrapper {
    position: fixed;
    top: 0;
    /*left: -100%;*/
    right: -100%;
    height: 100%;
    width: 100%;
    background: var(--appColor-light);
    transition: all 0.6s ease-in-out;
}
#active:checked ~ .wrapper {
    /*left: 0;*/
    right: 0;
}
.menu-btn {
    position: absolute;
    z-index: 2;
    right: 20px;
    /*left: 20px; */
    top: 15px;
    height: 50px;
    width: 50px;
    text-align: center;
    line-height: 50px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}
.menu-btn span,
.menu-btn:before,
.menu-btn:after {
    content: "";
    position: absolute;
    top: calc(50% - 1px);
    left: 30%;
    width: 40%;
    border-bottom: 2px solid var(--appColor-black);
    transition: transform 0.6s cubic-bezier(0.215, 0.61, 0.355, 1);
}
.menu-btn:before {
    transform: translateY(-8px);
}
.menu-btn:after {
    transform: translateY(8px);
}

.close {
    z-index: 1;
    width: 100%;
    height: 100%;
    pointer-events: none;
    transition: background 0.6s;
}

/* closing animation */
#active:checked + .menu-btn span {
    transform: scaleX(0);
}
#active:checked + .menu-btn:before {
    transform: rotate(45deg);
    border-color: var(--appColor-black);
}
#active:checked + .menu-btn:after {
    transform: rotate(-45deg);
    border-color: var(--appColor-black);
}
.wrapper ul {
    position: absolute;
    top: 60%;
    left: 50%;
    height: 90%;
    transform: translate(-50%, -50%);
    list-style: none;
    text-align: center;
}
.wrapper ul li {
    height: 10%;
    margin: 15px 0;
}
.wrapper ul li a {
    text-decoration: none;
    font-size: 30px;
    font-weight: 500;
    padding: 5px 30px;
    color: var(--appColor-light);
    border-radius: 50px;
    position: absolute;
    line-height: 50px;
    margin: 5px 30px;
    opacity: 0;
    transition: all 0.3s ease;
    transition: transform 0.6s cubic-bezier(0.215, 0.61, 0.355, 1);
}
.wrapper ul li a:after {
    position: absolute;
    content: "";
    background: var(--appColor-light);
    width: 100%;
    height: 100%;
    left: 0;
    top: 0;
    border-radius: 50px;
    transform: scaleY(0);
    z-index: -1;
    transition: transform 0.3s ease;
}
.wrapper ul li a:hover:after {
    transform: scaleY(1);
}
.wrapper ul li a:hover {
    color: var(--appColor-dark);
}
input[type="checkbox"] {
    display: none;
}
#active:checked ~ .wrapper ul li a {
    opacity: 1;
}
.wrapper ul li a {
    transition: opacity 1.2s, transform 1.2s cubic-bezier(0.215, 0.61, 0.355, 1);
    transform: translateX(100px);
}
#active:checked ~ .wrapper ul li a {
    transform: none;
    transition-timing-function: ease, cubic-bezier(0.1, 1.3, 0.3, 1); /* easeOutBackを緩めた感じ */
    transition-delay: 0.6s;
    transform: translateX(-100px);
}
</style>

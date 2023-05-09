<script setup>
import Navbar from "../Components/MainApp/Navbar.vue";
import Footer from "../Components/MainApp/Footer.vue";
import FlashMessage from "../Components/shared/FlashMessage.vue";
</script>

<template>
    <div class="w-full fixed z-30">
        <Navbar />
    </div>

    <FlashMessage />

    <div class="w-full">
        <slot />
    </div>

    <div class="w-full z-30">
        <Footer />
    </div>
</template>

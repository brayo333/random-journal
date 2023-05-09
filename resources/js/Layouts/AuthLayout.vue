<script setup>
import FlashMessage from "../Components/shared/FlashMessage.vue";
</script>

<template>
    <div class="w-full flex flex-row justify-center">
        <div class="w-full max-w-[1536px]">
            <FlashMessage />
            <slot />
        </div>
    </div>
</template>

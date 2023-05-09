<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm textColorError">
            {{ message }}
        </p>
    </div>
</template>

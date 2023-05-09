<script setup></script>

<template>
    <div class="w-full h-screen flex flex-col justify-center items-center">
        <div>Hello there and welcome {{ $page.props.auth.user.name }}</div>
    </div>
</template>

<script setup>
const currentYear = new Date().getFullYear();
</script>

<template>
    <footer className="w-full bottom-0 flex flex-row justify-center">
        <div className="w-full max-w-[1536px] md:px-5 px-10 py-5">
            <div class="w-full pt-5 text-center text-sm">
                <p class="textColorBlack">
                    Copyright {{ currentYear }} &copy;
                    <a
                        href="https://brianmulaa.com/"
                        target="_blank"
                        rel="noopener"
                        class="linkHover"
                        >Brian Mulaa</a
                    >.
                </p>
            </div>
        </div>
    </footer>
</template>

<style>
.linkHover {
    transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    -o-transition: all 0.5s ease-in-out;
    -moz-transition: all 0.5s ease-in-out;
}
.linkHover:hover {
    color: var(--appColor-darkAccent);
}
</style>

<script setup>
import { Link, router, useForm, usePage } from "@inertiajs/vue3";
import { ref, onMounted } from "vue";
import { Icon } from "@iconify/vue";
import imagePath from "../../../img/auth_bg.webp";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Input from "@/Components/shared/Input.vue";
import Button from "@/Components/shared/Button.vue";
import InputError from "@/Components/shared/InputError.vue";
import InputLabel from "@/Components/shared/InputLabel.vue";

const isPasswordVisible = ref(false);

const welcomeText = "Log into your account";

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post("/login", {
        onFinish: () => form.reset(),
    });
};

const togglePasswordVisibility = () => {
    isPasswordVisible.value = !isPasswordVisible.value;
};

onMounted(() => {
    if (usePage().props.auth.loggedIn) {
        router.visit("/journal");
    }
});
</script>

<template>
    <AuthLayout>
        <div class="w-full h-screen flex flex-row">
            <!-- Image -->
            <!-- Photo by <a href="https://unsplash.com/@honza_kahanek?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Jan Kahánek</a> on <a href="https://unsplash.com/photos/fVUl6kzIvLg?utm_source=unsplash&utm_medium=referral&utm_content=creditCopyText">Unsplash</a> -->

            <div
                class="md:hidden w-1/2 h-full py-10 px-12 flex flex-col justify-center items-center imageStyle relative"
                :style="{ backgroundImage: `url(${imagePath})` }"
            >
                <div
                    class="w-full h-full absolute top-0 left-0 imageStyleBlur"
                ></div>

                <Link
                    class="flex flex-row items-center textColorLight absolute left-12 top-10"
                    href="/"
                >
                    <Icon
                        class="mr-3"
                        icon="material-symbols:arrow-back-ios-new-rounded"
                        height="24"
                        color="inherit"
                    />
                    Back To Homepage
                </Link>

                <p class="text-xl text-center textColorLight z-20">
                    Hello there! {{ welcomeText }}
                </p>
            </div>

            <!-- Login form -->
            <div
                class="md:w-full w-1/2 h-full py-10 md-min:px-24 md:px-5 flex flex-col justify-center"
            >
                <h3 class="md-min:mb-5 font-semibold text-2xl">Welcome Back</h3>

                <p class="md-min:hidden my-3">
                    {{ welcomeText }}
                </p>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel class="" for="email" value="Email" />

                        <Input
                            id="email"
                            class="mt-1"
                            type="email"
                            option="rounded"
                            backgroundColor="transparent"
                            color="var(--appColor-black)"
                            placeholder="Enter email here"
                            border="1px solid var(--appColor-black)"
                            v-model="form.email"
                            required
                            autofocus
                        />

                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-4">
                        <InputLabel class="" for="password" value="Password" />

                        <div class="relative">
                            <Input
                                id="password"
                                class="mt-1"
                                :type="isPasswordVisible ? 'text' : 'password'"
                                option="rounded"
                                backgroundColor="transparent"
                                color="var(--appColor-black)"
                                placeholder="Enter password here"
                                border="1px solid var(--appColor-black)"
                                padding="6px 32px 6px 12px"
                                v-model="form.password"
                                required
                            />

                            <Button
                                type="button"
                                class="absolute right-1 top-2"
                                padding="2px"
                                option="rounded"
                                backgroundColor="transparent"
                                color="var(--dashColor-black)"
                                hasIcon
                                iconBtn
                                @clicked="togglePasswordVisibility()"
                                ><template #icon
                                    ><Icon
                                        class=""
                                        :icon="
                                            isPasswordVisible
                                                ? 'gridicons:not-visible'
                                                : 'gridicons:visible'
                                        "
                                        height="24"
                                        color="inherit" /></template
                            ></Button>
                        </div>

                        <InputError
                            class="mt-2"
                            :message="form.errors.password"
                        />
                    </div>

                    <div class="mt-5 flex flex-row justify-end">
                        <p class="text-sm">
                            Don't have an account?
                            <Link
                                href="/register"
                                class="textColorMain linkHover"
                            >
                                Register
                            </Link>
                        </p>
                    </div>

                    <div class="mt-10">
                        <Button
                            type="submit"
                            class="w-full"
                            :class="{ 'opacity-25': form.processing }"
                            option="rounded"
                            label="Log In"
                            backgroundColor="var(--appColor-black)"
                            color="var(--appColor-light)"
                            :disabled="form.processing"
                        />
                    </div>
                </form>
            </div>
        </div>
    </AuthLayout>
</template>

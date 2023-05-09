<script setup>
import { Link, useForm, router } from "@inertiajs/vue3";
import { ref } from "vue";
import { Icon } from "@iconify/vue";
import imagePath from "../../../img/auth_bg.webp";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import Input from "@/Components/shared/Input.vue";
import Button from "@/Components/shared/Button.vue";
import InputError from "@/Components/shared/InputError.vue";
import InputLabel from "@/Components/shared/InputLabel.vue";

const isPasswordVisible = ref(false);
const isConfirmPasswordVisible = ref(false);

const welcomeText = "Create an account and start making your journal entries";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post("/register", {
        onFinish: () => form.reset(),
    });
};

const togglePasswordVisibility = () => {
    isPasswordVisible.value = !isPasswordVisible.value;
};

const toggleConfirmPasswordVisibility = () => {
    isConfirmPasswordVisible.value = !isConfirmPasswordVisible.value;
};
</script>

<template>
    <AuthLayout>
        <div class="w-full h-screen flex flex-row">
            <!-- Register form -->
            <div
                class="md:w-full w-1/2 h-full py-10 md-min:px-24 md:px-5 flex flex-col justify-center"
            >
                <h3 class="mb-4 font-semibold text-2xl">Hello There!</h3>

                <p class="md-min:hidden mb-3">
                    {{ welcomeText }}
                </p>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel class="" for="name" value="Name" />
                        <Input
                            id="name"
                            class="mt-1"
                            type="text"
                            option="rounded"
                            backgroundColor="transparent"
                            color="var(--appColor-black)"
                            placeholder="Enter your name here"
                            border="1px solid var(--appColor-black)"
                            v-model="form.name"
                            required
                            autofocus
                        />
                        <InputError class="mt-2" :message="form.errors.name" />
                    </div>

                    <div class="mt-4">
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
                                color="var(--appColor-black)"
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

                    <div class="mt-4">
                        <InputLabel
                            class=""
                            for="password_confirmation"
                            value="Confirm Password"
                        />

                        <div class="relative">
                            <Input
                                id="password_confirmation"
                                class="mt-1"
                                :type="
                                    isConfirmPasswordVisible
                                        ? 'text'
                                        : 'password'
                                "
                                option="rounded"
                                backgroundColor="transparent"
                                color="var(--appColor-black)"
                                placeholder="Confirm your password here"
                                border="1px solid var(--appColor-black)"
                                padding="6px 32px 6px 12px"
                                v-model="form.password_confirmation"
                                required
                            />

                            <Button
                                type="button"
                                class="absolute right-1 top-2"
                                padding="2px"
                                option="rounded"
                                backgroundColor="transparent"
                                color="var(--appColor-black)"
                                hasIcon
                                iconBtn
                                @clicked="toggleConfirmPasswordVisibility()"
                                ><template #icon
                                    ><Icon
                                        class=""
                                        :icon="
                                            isConfirmPasswordVisible
                                                ? 'gridicons:not-visible'
                                                : 'gridicons:visible'
                                        "
                                        height="24"
                                        color="inherit" /></template
                            ></Button>
                        </div>

                        <InputError
                            class="mt-2"
                            :message="form.errors.password_confirmation"
                        />
                    </div>

                    <div
                        class="mt-5 flex flex-row justify-end"
                    >
                        <p class="text-sm">
                            Already registered?
                            <Link
                                href="/login"
                                class="textColorMain linkHover"
                            >
                                Login
                            </Link>
                        </p>
                    </div>

                    <div class="mt-10">
                        <Button
                            type="submit"
                            class="w-full"
                            :class="{ 'opacity-25': form.processing }"
                            option="rounded"
                            label="Register"
                            backgroundColor="var(--appColor-black)"
                            color="var(--appColor-light)"
                            :disabled="form.processing"
                        />
                    </div>
                </form>
            </div>

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
                    class="flex flex-row items-center absolute right-12 top-10 textColorLight"
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

                <p class="text-xl text-center textColorLight z-20">Welcome! {{ welcomeText }}</p>
            </div>
        </div>
    </AuthLayout>
</template>

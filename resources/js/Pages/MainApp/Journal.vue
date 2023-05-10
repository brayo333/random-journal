<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import { Icon } from "@iconify/vue";
import InputLabel from "../../Components/shared/InputLabel.vue";
import Button from "../../Components/shared/Button.vue";
import InputError from "../../Components/shared/InputError.vue";
import TextArea from "../../Components/shared/TextArea.vue";

const textAreaCount = ref(0);
const showEntryDropdown = ref(false);
const showEntryDropdownIndex = ref(null);

const countText = () => {
    // textAreaCount.value = 500 - form.entry.length;
    textAreaCount.value = form.entry.length;
};

const convertDateTime = (timeString) => {
    const date = new Date(timeString);
    const day = String(date.getDate()).padStart(2, "0");
    const year = String(date.getFullYear());
    const month = String(date.getMonth() + 1).padStart(2, "0");

    const hours = date.getHours();
    const minutes = String(date.getMinutes()).padStart(2, "0");
    const amPm = hours >= 12 ? "pm" : "am";
    const formattedHours = hours % 12 === 0 ? 12 : hours % 12;

    return `${day}-${month}-${year} ${formattedHours}:${minutes} ${amPm}`;
};

const form = useForm({
    entry: "",
});

const submit = () => {
    form.post("/journal/new", {
        onFinish: () => form.reset(),
    });
};

const deleteEntryForm = useForm({});

const destroy = (id) => {
    if (confirm("Are you sure you want to delete this entry?")) {
        deleteEntryForm.delete(`/journal/${id}`, id);
    }
};
</script>

<template>
    <div class="w-full py-32 flex flex-col justify-center items-center">
        <form @submit.prevent="submit" class="w-full mt-5">
            <div class="mb-5 relative">
                <InputLabel
                    class=""
                    for="entry"
                    value="Let others know your thoughts"
                />

                <TextArea
                    id="entry"
                    class="mt-1 relative"
                    type="text"
                    option="slightlyRounded"
                    backgroundColor="transparent"
                    color="var(--appColor-black)"
                    placeholder="What's on your mind?"
                    border="1px solid var(--appColor-black)"
                    v-model="form.entry"
                    required
                    maxlength="500"
                    @keyup="countText()"
                />

                <span class="text-xs absolute right-0 -bottom-4"
                    >{{ textAreaCount }} / 500</span
                >

                <InputError class="mt-2" :message="form.errors.entry" />
            </div>

            <div>
                <Button
                    type="submit"
                    class=""
                    padding=""
                    label="Submit"
                    option="rounded"
                    backgroundColor="var(--appColor-black)"
                    color="var(--appColor-light)"
                />
            </div>
        </form>

        <div class="w-full mt-10">
            <h2 class="font-medium text-2xl">My Entries</h2>

            <div class="w-full mt-5 flex flex-col">
                <div
                    v-if="$page.props.userEntries.length > 0"
                    v-for="(entry, index) in $page.props.userEntries"
                >
                    <div
                        class="w-full flex flex-row justify-between items-center"
                    >
                        <p class="italic">
                            {{ convertDateTime(entry.created_at) }}
                        </p>

                        <div class="relative">
                            <Button
                                type="button"
                                class=""
                                padding="2px"
                                option="rounded"
                                backgroundColor="transparent"
                                color="var(--appColor-black)"
                                hasIcon
                                iconBtn
                                @clicked="
                                    showEntryDropdown = !showEntryDropdown;
                                    showEntryDropdownIndex = index;
                                "
                                ><template #icon
                                    ><Icon
                                        class=""
                                        icon="material-symbols:more-vert"
                                        height="24"
                                        color="inherit" /></template
                            ></Button>

                            <div
                                class="p-5 rounded-2xl appBgColorWhite absolute right-0 -bottom-24 z-30"
                                :class="
                                    showEntryDropdown &&
                                    showEntryDropdownIndex == index
                                        ? ''
                                        : 'hidden'
                                "
                            >
                                <div>
                                    <Button
                                        type="button"
                                        class="w-[140px] h-[36px]"
                                        padding=""
                                        label="Delete"
                                        option="rounded"
                                        backgroundColor="var(--appColor-errorText)"
                                        color="var(--appColor-light)"
                                        hasIcon
                                        @clicked="
                                            destroy(entry.id);
                                            showEntryDropdown = false;
                                        "
                                        ><template #icon
                                            ><Icon
                                                class=""
                                                icon="solar:trash-bin-trash-bold"
                                                height="24"
                                                color="inherit" /></template
                                    ></Button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="mt-3">{{ entry.entry }}</p>

                    <hr class="h-[2px] my-5 appBgColorDark" />
                </div>

                <div
                    v-else
                    class="w-full flex flex-col justify-center items-center"
                >
                    <p class="text-center">
                        No entries found. You can add some in the text area
                        above
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
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
</script>

<template>
    <div class="w-full py-32 flex flex-col justify-center items-center">
        <div class="w-full mt-5">
            <h2 class="font-medium text-2xl">
                Random Entries (Other people's thoughts)
            </h2>

            <div class="w-full mt-5 flex flex-col">
                <div
                    v-if="$page.props.randomEntries.length > 0"
                    v-for="entry in $page.props.randomEntries"
                >
                    <p class="italic">
                        {{ convertDateTime(entry.created_at) }}
                    </p>

                    <p class="mt-3">{{ entry.entry }}</p>

                    <hr class="h-[2px] my-5 appBgColorDark" />
                </div>

                <div v-else class="w-full flex flex-col justify-center items-center">
                    <p class="text-center">
                        No entries found. The random entries are updated
                        everyday at 12:00pm (noon, EAT) and are only visible to those
                        who shared an entry between 12:00pm (EAT) and now.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

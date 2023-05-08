<script setup lang="ts">
import { reactive } from "vue";

interface Props {
    id?: string;
    name?: string;
    class?: string;
    type?: string;
    min?: string | number | undefined;
    max?: string | number | undefined;
    step?: number;
    modelValue?: string | number | undefined;
    option?: "circle" | "rounded" | "slightlyRounded" | "box" | "line";
    border?: string;
    width?: string;
    padding?: string;
    boxShadow?: string;
    backgroundColor?: string;
    placeholder?: string;
    fontSize?: string;
    color?: string;
    readonly?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    id: undefined,
    name: undefined,
    class: undefined,
    type: undefined,
    min: undefined,
    max: undefined,
    step: undefined,
    modelValue: "",
    option: undefined,
    border: undefined,
    width: undefined,
    padding: undefined,
    boxShadow: undefined,
    backgroundColor: undefined,
    placeholder: "",
    fontSize: undefined,
    color: undefined,
    readonly: false,
});

const emit = defineEmits<{
    (event: "update:modelValue", payload: string | number | undefined): void;
}>();

const updateValue = (e: Event) => {
    emit("update:modelValue", (e.target as HTMLInputElement).value);
};

// we will use the following styleObject variable for the textarea's style attribute
const styleObject = reactive({
    width: props.width,
    padding: props.padding,
    backgroundColor: props.backgroundColor,
    boxShadow: props.boxShadow,
    fontSize: props.fontSize,
    color: props.color,
    border: props.border,
});
</script>

<template>
    <textarea
        :id="props.id"
        :name="props.name"
        :type="props.type"
        :min="props.min"
        :max="props.max"
        :step="props.step"
        :value="modelValue"
        @input="updateValue"
        :placeholder="props.placeholder"
        :class="
            ['textAreaStyle', `textAreaStyle--${props.option}`, props.class].join(' ')
        "
        :readOnly="props.readonly"
        :style="styleObject"
        rows="5"
    />
</template>

<style>
:root {
    --inputText-color: inherit;
    --inputBorder-color: #000000;
}

textarea:focus {
    outline: none;
}

.textAreaStyle {
    padding: 6px 12px;
    border: 0px;
    color: var(--inputText-color);
    width: 100%;
}

.textAreaStyle--circle {
    border-radius: 50px;
    border: 1px solid var(--appColor-black);
}
.textAreaStyle--rounded {
    border-radius: 50px;
    border: 1px solid var(--appColor-black);
}
.textAreaStyle--slightlyRounded {
    border-radius: 7px;
    border: 1px solid var(--appColor-black);
}
.textAreaStyle--box {
    border-radius: 0;
    border: 1px solid var(--appColor-black);
}
.textAreaStyle--line {
    box-shadow: 0px 1px 0px var(--inputBorder-color);
}

textarea[type="number"]::-webkit-inner-spin-button,
textarea[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
}

textarea[type="number"] {
    -moz-appearance: textfield;
}

.activeInputGlow:focus {
    outline: none;
    border-color: var(--appColor-main);
    box-shadow: 0 0 5px var(--appColor-main);
}
</style>

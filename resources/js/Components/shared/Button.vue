<script setup lang="ts">
import { reactive } from "vue";

interface Props {
    id?: string;
    type?: any;
    class?: string;
    primary?: boolean;
    option?: "circle" | "rounded" | "slightlyRounded" | "box" | "line";
    border?: string;
    width?: string;
    padding?: string;
    backgroundColor?: string;
    fontSize?: string;
    color?: string;
    label?: string;
    hasIcon?: boolean;
    iconBtn?: boolean;
}

const props = withDefaults(defineProps<Props>(), {
    id: undefined,
    type: undefined,
    class: undefined,
    primary: true,
    option: undefined,
    border: undefined,
    backgroundColor: undefined,
    width: undefined,
    padding: undefined,
    fontSize: undefined,
    color: undefined,
    label: undefined,
    hasIcon: false,
    iconBtn: false,
});

const mode = props.primary ? "buttonStyle--primary" : "buttonStyle--secondary";
const iconMode = props.iconBtn ? "" : "btnIcon--withIcon";

const styleObject = reactive({
    width: props.width,
    padding: props.padding,
    backgroundColor: props.backgroundColor,
    fontSize: props.fontSize,
    color: props.color,
    border: props.border,
});
</script>

<template>
    <button
        :id="props.id"
        :type="props.type"
        :class="
            [
                'buttonStyle',
                `buttonStyle--${props.option}`,
                props.class,
                mode,
            ].join(' ')
        "
        :style="styleObject"
        @click="$emit('clicked')"
    >
        <div v-if="props.hasIcon" class="btnIcon--div">
            <span :class="['btnIcon', iconMode].join(' ')"
                ><slot name="icon"></slot
            ></span>
            <span>{{ label }}</span>
        </div>
        <span v-else>{{ label }}</span>
    </button>
</template>

<style>
:root {
    --btnBorder-color: var(--appColor-light);
    --btnPrimary-bgColor: var(--appColor-light);
    --btnSecondary-bgColor: transparent;
    --btnPrimary-textColor: inherit;
    --btnSecondary-textColor: inherit;
}

button:focus {
    outline: none;
}

.buttonStyle {
    box-sizing: border-box;
    padding: 6px 25px;
    cursor: pointer;
}

.buttonStyle--primary {
    border: 0px;
    background-color: var(--btnPrimary-bgColor);
    color: var(--btnPrimary-textColor);
}
.buttonStyle--secondary {
    border: 1px solid var(--btnBorder-color);
    background-color: var(--btnSecondary-bgColor);
    color: var(--btnSecondary-textColor);
}

.buttonStyle--circle {
    padding: 10px;
    border-radius: 100px;
}
.buttonStyle--rounded {
    border-radius: 50px;
}
.buttonStyle--slightlyRounded {
    border-radius: 7px;
}
.buttonStyle--box {
    border-radius: 0;
}
.buttonStyle--line {
    border-radius: 0;
}

.btnIcon--div {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}
.btnIcon {
    display: inline-flex;
}
.btnIcon--withIcon {
    margin-right: 7px;
}
</style>

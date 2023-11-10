<script setup>
import { ref, computed, onMounted } from "vue";

const emit = defineEmits(['update-slider']);

const props = defineProps({
    sliderMin:{
        type:[Number, String], 
        default:0
    },
    sliderMax:{
        type:[Number, String], 
        default:100
    },
    sliderStep:{
        type:[Number, String], 
        default:10
    },
    dollarFormat:{
        type:Boolean,
        default:false
    },
    sliderStart:{
        type:[Number, String],
        default:0
    }
});

const sliderValue = ref(50);
const slider = ref({});
const progress = computed(() => ((sliderValue.value - slider.value.min) / (slider.value.max - slider.value.min)) * 100);

// const extraWidth = computed(() => (100 - progress.value) / 10);

const steps = computed(() => {
    let _steps = [];
    for (let i = props.sliderMin; i <= props.sliderMax; i += props.sliderStep ) {
        _steps = [..._steps, i];
    }
    return _steps;
});

const onChangeEmit = () => { emit('update-slider', sliderValue) } 

onMounted(() => {
    sliderValue.value = props.sliderStart ?? props.sliderMin;
});
</script>

<template>  
    <div class="rangeSlider" :style="{ '--ProgressPercent' : `${progress}%` }">
        <input
        v-model="sliderValue"
        type="range"
        :min="sliderMin"
        :max="sliderMax"
        :step="sliderStep"
        class="rangeSlider_input"
        ref="slider"
        @change="onChangeEmit"
        />
        <div class="rangeSlider_dots">
            <div :class="['rangeSlider_dot', {'-current': dot == sliderValue}, {'-active': dot < sliderValue}]" v-for="dot in steps"></div>
        </div>
    </div>

    <div class="rangeSlider_values">
        <div :class="['rangeSlider_value', {'-active': range == sliderValue}]" v-for="range in steps">{{ dollarFormat? `$${range.toLocaleString("en-US")}` : `${range}%` }}</div>
    </div>
</template>

<template>
    <span :class="(value < 0) ? 'text-red-500' : 'text-green-700'">
        {{ sign ?? 'AR$' }} {{ value?.toLocaleString('es-AR', {style: 'decimal', minimumFractionDigits: 2}) ?? 0 }}
    </span>
</template>

<script setup>

let props = defineProps({
    sign: String,
    value: Number,
});
</script>

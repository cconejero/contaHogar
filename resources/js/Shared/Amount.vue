<template>
    <span :class="(!spend) ? ((value < 0) ? 'text-red-500' : 'text-green-700') : ((value < 0) ? 'text-green-700' : 'text-red-500')">
        {{ sign ?? 'AR$' }} {{ value?.toLocaleString('es-AR', {style: 'decimal', minimumFractionDigits: 2}) ?? 0 }}
    </span>
</template>

<script setup>

let props = defineProps({
    sign: String,
    value: Number,
    spend: Boolean
});

</script>

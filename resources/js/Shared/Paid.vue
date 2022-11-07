<template>
    <span v-if="props.paid" class="bg-green-400 rounded-full px-3 py-1">Pagado</span>
    <span v-else class="bg-red-400 rounded-full px-3 py-1">A pagar</span>
</template>

<script setup>

let props = defineProps({
    paid: Boolean,
});

</script>

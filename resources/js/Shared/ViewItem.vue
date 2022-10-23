<template>
    <div class="even:bg-gray-50 odd:bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
        <dt class="text-sm font-medium text-gray-500">{{ title }}</dt>
        <dd class="mt-1 text-sm text-gray-900 sm:col-span-2 sm:mt-0">
            <slot />
        </dd>
    </div>
</template>

<script setup>

let props = defineProps({
    title: String
});

</script>

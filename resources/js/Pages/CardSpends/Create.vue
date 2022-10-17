<template>
    <head title="Crear Gasto en Tarjeta"/>

    <h1 class="text-3xl">Crear Gasto en {{ card.name }}</h1>

    <form @submit.prevent="submit" class="mt-8 max-w-md mx-auto">

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="description"
            >
                Descripcion
            </label>

            <input v-model="form.description"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="text"
                   name="description"
                   id="description"
                   required
            >
            <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="amount"
            >
                Cuota
            </label>

            <input v-model="form.amount"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="number"
                   name="amount"
                   id="amount"
                   required
            >
            <div v-if="form.errors.amount" v-text="form.errors.amount" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="actual_due"
            >
                Cuta actual
            </label>

            <input v-model="form.actual_due"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="number"
                   name="actual_due"
                   id="actual_due"

            >
            <div v-if="form.errors.actual_due" v-text="form.errors.actual_due" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="total_due"
            >
                De cuotas
            </label>

            <input v-model="form.total_due"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="number"
                   name="total_due"
                   id="total_due"

            >
            <div v-if="form.errors.total_due" v-text="form.errors.total_due" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="month"
            >
                Período mes
            </label>

            <input v-model="form.month"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="number"
                   name="month"
                   id="month"

            >
            <div v-if="form.errors.month" v-text="form.errors.month" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="year"
            >
                Período año
            </label>

            <input v-model="form.year"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="number"
                   name="year"
                   id="year"

            >
            <div v-if="form.errors.year" v-text="form.errors.year" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <button type="submit"
                    class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500"
                    :disabled="form.processing"
            >
                Submit
            </button>
        </div>

    </form>
</template>

<script setup>

import {useForm} from "@inertiajs/inertia-vue3"

let form = useForm({
    description: '',
    amount: 0,
    actual_due: 1,
    total_due: 1,
    year: new Date().getFullYear(),
    month: new Date().getMonth() + 1,
});

let props = defineProps({
    card: Object,
});

let submit = () => {
    form.post('/cards/' + props.card.id + '/spends');
};

</script>

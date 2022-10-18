<template>
    <head title="Crear Tarjeta"/>

    <h1 class="text-3xl">Crear Tarjeta</h1>

    <form @submit.prevent="submit" class="mt-8 max-w-md mx-auto">

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="name"
            >
                Descripción
            </label>

            <input v-model="form.name"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="text"
                   name="name"
                   id="name"
                   required
            >
            <div v-if="form.errors.name" v-text="form.errors.name" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">

            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="bank_id"
            >
                Banco
            </label>

            <Radio :items="props.banks" v-model="form.bank_id">Banco</Radio>

            <div v-if="form.errors.bank_id" v-text="form.errors.bank_id" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="brand"
            >
                Marca
            </label>

            <Radio :items="props.brands" v-model="form.card_brand_id">Marca</Radio>

            <div v-if="form.errors.card_brand_id" v-text="form.errors.card_brand_id" class="text-red-500 text-xs mt-1"></div>
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
import Radio from "../../Shared/Radio"

let form = useForm({
    name: '',
    bank_id: 1,
    card_brand_id: 1,
});

let props = defineProps({
    banks: Object,
    brands: Object,
});

let submit = () => {
    form.post('/cards');
};

</script>

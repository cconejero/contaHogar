<template>
    <Layout>
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
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="generation_day_name"
            >
                Día de cierre
            </label>

            <Radio :items="days" v-model="form.generation_day_name">Día de cierre</Radio>

            <div v-if="form.errors.generation_day_name" v-text="form.errors.generation_day_name" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="generation_day_number"
            >
                Numero de día cierre
            </label>

            <input v-model="form.generation_day_number"
                   class="border rounded-xl border-gray-400 p-2 w-full"
                   type="number"
                   name="generation_day_number"
                   id="generation_day_number"
                   required
            >
            <div v-if="form.errors.generation_day_number" v-text="form.errors.generation_day_number" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="due_day_name"
            >
                Día de vencimiento
            </label>

            <Radio :items="days" v-model="form.due_day_name">Día de vencimiento</Radio>

            <div v-if="form.errors.due_day_name" v-text="form.errors.due_day_name" class="text-red-500 text-xs mt-1"></div>
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
    </Layout>
</template>

<script setup>

import {useForm} from "@inertiajs/inertia-vue3"
import Radio from "../../Shared/Radio"
import Layout from "../../Shared/Layout";


const days = [
    { id: 'Monday', name: 'Lunes' },
    { id: 'Tuesday', name: 'Martes' },
    { id: 'Wednesday', name: 'Miercoles' },
    { id: 'Thursday', name: 'Jueves' },
    { id: 'Friday', name: 'Viernes' },
];

let form = useForm({
    name: '',
    bank_id: 1,
    card_brand_id: 1,
    generation_day_name: 'Monday',
    generation_day_number: 1,
    due_day_name: 'Monday'
});

let props = defineProps({
    banks: Object,
    brands: Object,
});

let submit = () => {
    form.post('/cards');
};

</script>

<template>
    <Layout>
    <head title="Crear Gasto en Tarjeta"/>

    <h1 class="text-3xl">Crear Gasto en {{ card.name }}</h1>
    <h2 class="text-sm">Período {{ month }}/{{ year }}</h2>

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
                   for="currency_id"
            >
                Moneda
            </label>

            <Radio :items="props.currencies" v-model="form.currency_id" />

            <div v-if="form.errors.currency_id" v-text="form.errors.currency_id" class="text-red-500 text-xs mt-1"></div>
        </div>

        <div class="mb-6">
            <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                   for="amount"
            >
                Valor de Cuota
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
            <SwitchGroup>
                <div class="flex items-center">
                    <Switch
                        v-model="enabled"
                        :class="enabled ? 'bg-blue-500' : 'bg-gray-500'"
                        @click="fixedHandler"
                        class="relative inline-flex h-[38px] w-[74px] shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75"
                    >
                        <span class="sr-only">Gasto Fijo</span>
                        <span
                            aria-hidden="true"
                            :class="enabled ? 'translate-x-9' : 'translate-x-0'"
                            class="pointer-events-none inline-block h-[34px] w-[34px] transform rounded-full bg-white shadow-lg ring-0 transition duration-200 ease-in-out"
                        />
                    </Switch>
                    <SwitchLabel class="ml-4 font-bold">Gasto Fijo</SwitchLabel>
                </div>
            </SwitchGroup>
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
                   :disabled="form.fixed"
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
                   :disabled="form.fixed"
            >
            <div v-if="form.errors.total_due" v-text="form.errors.total_due" class="text-red-500 text-xs mt-1"></div>
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
import Layout from "../../../Shared/Layout";
import {Switch, SwitchGroup, SwitchLabel} from '@headlessui/vue'
import {ref} from "vue";
import Radio from "../../../Shared/Radio";

const enabled = ref(false);

let props = defineProps({
    card: Object,
    currencies: Object,
    month: Number,
    year: Number
});

let form = useForm({
    description: '',
    amount: 0,
    currency_id: 1,
    fixed: enabled,
    actual_due: 1,
    total_due: 1,
    year: props.year,
    month: props.month,
});

let fixedHandler = () => {
    form.actual_due = 1;
    form.total_due = 1;
};

let submit = () => {
    form.post('/cards/' + props.card.id + '/spends');
};

</script>

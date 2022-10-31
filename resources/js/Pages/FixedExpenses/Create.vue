<template>
    <Layout>
        <head title="Crear Gasto Fijo"/>

        <h1 class="text-3xl">Crear Gasto Fijo</h1>

        <form @submit.prevent="submit" class="mt-8 max-w-md mx-auto">

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="description"
                >
                    Descripción
                </label>

                <input v-model="form.description"
                       class="border rounded-xl border-gray-400 p-2 w-full"
                       type="text"
                       name="name"
                       id="name"
                       required
                >
                <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">

                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="amount"
                >
                    Monto
                </label>

                <input v-model="form.amount"
                       class="border rounded-xl border-gray-400 p-2 w-full"
                       type="number"
                       step="0.01"
                       min="0"
                       name="amount"
                       id="amount"
                       required
                >

                <div v-if="form.errors.amount" v-text="form.errors.amount" class="text-red-500 text-xs mt-1"></div>
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
                       for="due_date"
                >
                    Numero del día de vencimiento
                </label>

                <input v-model="form.due_date"
                       class="border rounded-xl border-gray-400 p-2 w-full"
                       type="number"
                       min="1"
                       max="28"
                       name="due_date"
                       id="due_date"
                       required
                >

                <div v-if="form.errors.due_date" v-text="form.errors.due_date" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="tag_id"
                >
                    Tipo de gasto
                </label>

                <select v-model="form.tag_id"
                        class="border rounded-xl border-gray-400 p-2 w-full bg-white">
                    <option v-for="tag in tags"
                            :value="tag.id"
                            :key="tag.id"
                    >{{ tag.name }}</option>
                </select>

                <div v-if="form.errors.tag_id" v-text="form.errors.tag_id" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="account_id"
                >
                    Debito Automático
                </label>

                <select v-model="form.account_id"
                        class="border rounded-xl border-gray-400 p-2 w-full bg-white">
                    <option value="null"
                            key="null"
                            selected
                    >Sin debito automático</option>
                    <option v-for="account in accounts"
                            :value="account.id"
                            :key="account.id"
                    >{{ account.description }}</option>
                </select>

                <div v-if="form.errors.account_id" v-text="form.errors.account_id" class="text-red-500 text-xs mt-1"></div>
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


let form = useForm({
    description: '',
    amount: 0,
    currency_id: 1,
    due_date: 1,
    tag_id: 1,
    account_id: null
});

let props = defineProps({
    currencies: Object,
    tags: Object,
    accounts: Object,
});

let submit = () => {
    form.post('/fixed_expenses');
};


</script>

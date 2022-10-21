<template>
    <Layout>
        <head title="Crear Cuenta"/>

        <h1 class="text-3xl">Crear Cuenta</h1>

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
                       name="description"
                       id="description"
                       required
                >
                <div v-if="form.errors.description" v-text="form.errors.description" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="alias"
                >
                    Alias
                </label>

                <input v-model="form.alias"
                       class="border rounded-xl border-gray-400 p-2 w-full"
                       type="text"
                       name="alias"
                       id="alias"
                >
                <div v-if="form.errors.alias" v-text="form.errors.alias" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="cbu"
                >
                    CBU
                </label>

                <input v-model="form.cbu"
                       class="border rounded-xl border-gray-400 p-2 w-full"
                       type="number"
                       name="cbu"
                       id="cbu"
                >
                <div v-if="form.errors.cbu" v-text="form.errors.cbu" class="text-red-500 text-xs mt-1"></div>
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
                       for="account_type_id"
                >
                    Tipo de Cuenta
                </label>

                <Radio :items="props.accounts_type" v-model="form.account_type_id">Marca</Radio>

                <div v-if="form.errors.account_type_id" v-text="form.errors.account_type_id" class="text-red-500 text-xs mt-1"></div>
            </div>

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="currency_id"
                >
                    Moneda
                </label>

                <Radio :items="props.currencies" v-model="form.currency_id">Marca</Radio>

                <div v-if="form.errors.currency_id" v-text="form.errors.currency_id" class="text-red-500 text-xs mt-1"></div>
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

import Layout from "../../Shared/Layout";
import Radio from "../../Shared/Radio";
import {useForm} from "@inertiajs/inertia-vue3";


let form = useForm({
    description: '',
    alias: '',
    cbu: '',
    bank_id: 1,
    account_type_id: 1,
    currency_id: 1
});

let props = defineProps({
    banks: Object,
    accounts_type: Object,
    currencies: Object
});

let submit = () => {
    form.post('/accounts');
};

</script>

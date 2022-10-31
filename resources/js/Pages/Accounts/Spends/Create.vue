<template>
    <Layout>
        <head title="Crear Movimiento en Cuenta"/>

        <h1 class="text-3xl">Crear Movimiento en {{ account.description }}</h1>

        <form @submit.prevent="submit" class="mt-8 max-w-md mx-auto">

            <div class="mb-6">
                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                       for="movement_id"
                >
                    Tipo de Movimiento
                </label>

                <Radio :items="props.movements" v-model="form.movement_id"></Radio>

                <div v-if="form.errors.movement_id" v-text="form.errors.movement_id" class="text-red-500 text-xs mt-1"></div>
            </div>

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
import Layout from "../../../Shared/Layout";
import {useForm} from "@inertiajs/inertia-vue3";
import Radio from "../../../Shared/Radio";


let form = useForm({
    movement_id: 2,
    description: '',
    amount: 0,
    tag_id: 1
});

let props = defineProps({
    account: Object,
    accountCycle: Object,
    movements: Object,
    tags: Object
});


let submit = () => {
    form.post('/account_spends/' + props.accountCycle.id);
};

</script>

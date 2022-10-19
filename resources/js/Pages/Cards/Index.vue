<template>
    <Layout>
    <Head title="Tarjetas" />

    <div class="flex justify-between items-center mb-6">
        <div class="flex items-center">
            <h1 class="text-3xl">Tarjetas</h1>

            <Link
                v-if="can.createCard"
                href="/cards/create"
                class="text-blue-500 text-sm ml-3"
            >Nueva Tarjeta</Link
            >
        </div>

        <input
            v-model="search"
            type="text"
            placeholder="Buscar..."
            class="border px-2 rounded-lg"
        />
    </div>

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div
                class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8"
            >
                <div
                    class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg"
                >
                    <table class="min-w-full divide-y divide-gray-200">
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="card in cards.data" :key="card.id">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div>
                                        <div
                                            class="text-sm font-medium text-gray-900 flex items-center"
                                        >
                                            <Link v-if="card.can.view"
                                                  :href="`/cards/${card.id}`"
                                                  class="text-indigo-600 hover:text-indigo-900 ml-4"
                                                  >{{ card.name }}</Link>
                                        </div>
                                    </div>
                                </div>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                            >
                                <div>{{ card.brand }}</div>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                            >
                                <div>{{ card.bankName }}</div>
                            </td>

                            <td
                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                            >
                                <Link
                                    v-if="card.can.edit"
                                    :href="`/cards/${card.id}/edit`"
                                    class="text-indigo-600 hover:text-indigo-900"
                                >
                                    Editar
                                </Link>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <Pagination :links="cards.links" class="mt-6" />
    </Layout>
</template>

<script setup>
import Pagination from "../../Shared/Pagination";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";
import Layout from "../../Shared/Layout";

let props = defineProps({
    cards: Object,
    filters: Object,
    can: Object,
});

let search = ref(props.filters.search);

watch(
    search,
    debounce(function (value) {
        Inertia.get(
            "/cards",
            { search: value },
            {
                preserveState: true,
                replace: true,
            }
        );
    }, 300)
);
</script>

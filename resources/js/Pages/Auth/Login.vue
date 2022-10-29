<template>
    <head title="Login Page"/>

    <main class="grid place-items-center min-h-screen">
        <section class="bg-white p-8 rounded-xl max-w-md mx-auto border drop-shadow-lg">

            <h1 class="text-3xl mb-6">Login</h1>

            <a class="w-full bg-red-500 text-white px-4 py-2 rounded" href="/auth/redirect">Ingresar con Google</a>

        </section>
    </main>
</template>

<script>
export default {
    name: "Login",
    layout: null,
}
</script>

<script setup>
    import {useForm} from "@inertiajs/inertia-vue3";

    let form = useForm({
        email: '',
        password: ''
    });

    let submit = () => {
        form.post('/login');
    };
</script>

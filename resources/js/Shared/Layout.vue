<template>
    <div class="min-h-full">
        <Nav />
        <main>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <slot />
            </div>
        </main>
    </div>
</template>

<script>
import Nav from "./Nav";
import { Head } from "@inertiajs/inertia-vue3";

export default {
    components: { Nav, Head },

    computed: {
        username() {
            return this.$page.props.auth.user.username;
        },
        avatar(){
            return this.$page.props.auth.user.avatar;
        },
        email(){
            return this.$page.props.auth.user.email
        }
    },
};
</script>

<template>

    <Link :class="{'font-bold underline' : active}"
          class="text-black hover:underline"
    >
        <slot/>
    </link>

</template>

<script>
import {Link} from "@inertiajs/inertia-vue3";

export default {
    components: {Link},
    props: {
        active: Boolean
    }
};
</script>

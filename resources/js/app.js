import { createApp, h } from 'vue'
import {createInertiaApp, Link, Head} from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import '../css/app.css';

createInertiaApp({
    resolve: async name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component("Head", Head)
            .mount(el)
    },

    title: title => "Little Erica - " + title,
});


InertiaProgress.init();

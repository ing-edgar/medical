import './bootstrap';
import '../css/app.css'; 

import { createInertiaApp } from '@inertiajs/inertia-svelte'
import { Inertia } from "@inertiajs/inertia";
createInertiaApp({
  resolve: name => import(`./Pages/${name}.svelte`),
  setup({ el, App, props }) {
    new App({ target: el, props })
  },
})

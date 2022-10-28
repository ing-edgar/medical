import { writable, derived } from 'svelte/store';
import { components } from "../services/components";

export const view = writable({
    component: null, // Nombre del componente
    data: null // Los datos alojados en el modal
});

// Buscará el componente y lo devolverá para su ejecución
export const component = derived(view, $view => {
    let component = null;
    if ($view.component) {
        component = components.find(
            (component) => component.name === $view.component
        ).component;
    } else {
        $view.data = null;
    }
    return component;
});
import {derived, writable} from "svelte/store";

export const request = writable({
    status: 0,
    data: {
        message: null, errors: []
    }
});

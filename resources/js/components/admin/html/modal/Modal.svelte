<script>
    import { fade, scale } from "svelte/transition";
    export let width = "w-2/5";
</script>

<div
    class="bg-slate-800 bg-opacity-50 flex justify-center items-center 
    absolute top-0 right-0 bottom-0 left-0 z-50" out:fade
>
    <div class="bg-white rounded-md {width}" in:scale >
        <div
            class="flex justify-between items-center 
            text-lg p-2 bg-gray-800 text-white"
        >
            <slot name="left" />
            <slot name="title" />
            <slot name="right" />
        </div>
        <div class="p-2 max-h-96 overflow-y-auto">
            <slot/>
        </div>
    </div>
</div>

<script>
    let className = "";
    export { className as class };
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();
</script>

<button
    class="border flex items-center space-x-2 {className} p-2 rounded-md"
    on:click={() => dispatch("click")}
>
    <slot />
</button>


<style>
    .registered {
        @apply bg-yellow-600 text-white;
    }
    .confirmed {
        @apply bg-purple-600 text-white;
    }
    .canceled {
        @apply bg-red-600 text-white;
    }
    .completed {
        @apply bg-green-600 text-white;
    }
</style>
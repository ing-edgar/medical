<script>
    let className = "";
    export { className as class };
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();
</script>

<button
    class="border px-3 py-1 rounded flex items-center space-x-2 {className}"
    on:click={() => dispatch("click")}
>
    <slot />
</button>

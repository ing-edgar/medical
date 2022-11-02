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

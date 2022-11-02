<script>
    import Fa from "svelte-fa/src/fa.svelte";

    import { createEventDispatcher } from "svelte";
    const dispatch = createEventDispatcher();
    let className;
    export let icon;
    export { className as class };
</script>

<button
    class="rounded-[50%] bg-gray-700  {className} 
    hover:bg-gray-600 h-7 w-7 flex justify-center items-center"
    on:click={() => dispatch("click")}
>
    <Fa {icon} class="h-3 w-3" />
</button>

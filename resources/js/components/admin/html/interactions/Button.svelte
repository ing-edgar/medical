<script>
    let className = "";
    export {className as class};
    import {createEventDispatcher} from "svelte";

    const dispatch = createEventDispatcher();
</script>

<button class={className} type="button" on:click={() => dispatch("click")}>
    <slot/>
</button>

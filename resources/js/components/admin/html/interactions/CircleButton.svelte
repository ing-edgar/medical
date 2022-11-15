<script>
    import Fa from "svelte-fa/src/fa.svelte";

    import {createEventDispatcher} from "svelte";

    const dispatch = createEventDispatcher();
    let className;
    export let icon;
    export {className as class};
</script>

<button class="{className}" on:click={() => dispatch("click")}>
    <Fa {icon}/>
</button>

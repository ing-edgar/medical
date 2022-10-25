<script>
    import Time from "./Time.svelte";
    import { createEventDispatcher } from "svelte";
    import Fa from "svelte-fa/src/fa.svelte";
    import { faTrash } from "@fortawesome/free-solid-svg-icons";
    const dispatch = createEventDispatcher();

    let isHidden = true;
    export let interval;
    console.log(interval);
    function remove() {
        dispatch("delete");
    }
</script>

<!-- svelte-ignore a11y-mouse-events-have-key-events -->
<div
    class="p-2 hover:bg-gray-100 rounded-md my-1"
    on:mouseover={() => (isHidden = false)}
    on:mouseout={() => (isHidden = true)}
>
    <div class="flex items-center">
        <span class="pr-2">de</span>
        <div>
            <Time bind:time={interval.start_time} />
        </div>
        <span class="px-2">a</span>
        <div>
            <Time bind:time={interval.end_time} />
        </div>
        <div class="px-2">
            <button
                type="button"
                class:hidden={isHidden}
                class="block text-gray-500"
                on:click={remove}
            >
                <Fa icon={faTrash} />
            </button>
        </div>
    </div>
</div>

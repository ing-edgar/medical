<script>
    import {faCircleCheck, faClose, faCircleExclamation} from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import {createEventDispatcher, onDestroy} from "svelte";
    import {request} from "@/services/request";

    const dispatch = createEventDispatcher();
    let icon = null;
    const unsubscribe = request.subscribe(value => {
        if (value.status >= 200 && value.status < 300) {
            icon = faCircleCheck;
        } else if (value.status === 422) {
            icon = faCircleExclamation;
        }
    })

    onDestroy(() => request.set({
        status: 0,
        data: {
            message: null,
            errors: []
        }
    }))

</script>

<div class="messages" class:success={$request.status >= 200 && $request.status<300}
     class:error={$request.status === 422}>
    <Fa icon="{icon}"></Fa>
    <div>{$request.data.message}</div>
    <div></div>
    {#if $request.data.errors}
        <ul>
            {#each Object.values($request.data.errors) as error}
                <li>{error}</li>
            {/each}
        </ul>
    {/if}
    <button type="button" class="close" on:click={()=>dispatch('click')}>
        <Fa icon="{faClose}"></Fa>
    </button>
</div>

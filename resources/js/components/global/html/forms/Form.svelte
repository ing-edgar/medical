<script>
    import Messages from "@/components/global/html/forms/Messages.svelte";
    import {request} from "@/services/request";


    let open = false;
    request.subscribe(value => {
        open = (value.status > 0 && value.status < 300) || value.status === 422;
    })


</script>

<section>

    {#if open}
        <Messages on:click={()=>$request.status=0}></Messages>
    {/if}
    <form class="form" on:submit|preventDefault={() => {}}>
        <slot></slot>
    </form>
</section>

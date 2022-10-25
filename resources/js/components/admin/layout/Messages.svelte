<script>
    import Error from "./Error.svelte";

    export let request = {
        status: 0,
        message: "",
        data: [],
    };
</script>

{#if request.status > 0}
    <div
        class="rounded-md p-2"
        class:error={request.status >= 400}
        class:success={request.status >= 200 && request.status < 300}
    >
        {request.message}

        {#if request.data}
            <Error errors={request.data} />
        {/if}
    </div>
{/if}

<style>
    .success {
        @apply bg-green-600 text-white;
    }
    .error {
        @apply bg-red-200 border-red-200 text-red-700;
    }
</style>

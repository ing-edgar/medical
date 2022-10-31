<script>
    export let errors = [];
</script>

<ul>
    {#each errors as error}
        <li class="px-2">{error[1]}</li>
    {/each}
</ul>

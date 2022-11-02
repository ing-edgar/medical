<script>
    import { onMount } from "svelte";
    export let value;
    let minutes = [];
    function buildMinuts() {
        for (let i = 0; i <= 60; i += 5) {
            minutes.push({ value: i });
            minutes = minutes;
        }
    }

    onMount(() => buildMinuts());
</script>

<select class="w-full p-2 bg-gray-300 rounded-md" bind:value>
    <option value="-1">--</option>
    {#each minutes as min}
        <option value={min.value}>{min.value}</option>
    {/each}
</select>

<script>
    import {onMount} from 'svelte';
    import moment from 'moment';

    let hours = [];
    export let time;
    onMount(() => {
        hours = Array.from({length: 24}, (_, i) => i).reduce((r, hour) => {
            r.push(moment({hour, minute: 0}).format('h:mm A'));
            r.push(moment({hour, minute: 30}).format('h:mm A'));
            return r;
        }, []);
    });
</script>

<div>
    <select name="hour" id="hour" class="px-2 py-1 rounded-full bg-gray-100" bind:value={time}>
        {#each hours as hour}
            <option value={hour}>{hour}</option>
        {/each}
    </select>
</div>

<script>
    import {getAvailableTime} from "../../../api/user";
    import {inputs} from "../../../services/form";
    import {onMount} from "svelte";
    import moment from "moment/moment";

    let availableTimes = {};
    let date;
    let selectedTime;
    onMount(() => getAvailable());

    async function getAvailable() {
        date = moment($inputs.date).locale("es").format("LL");

        const response = await getAvailableTime(
            $inputs.professional_id,
            $inputs.date
        );
        if (response.status === 200) {
            availableTimes = response.data;
        }
    }

    function selectedAvailableTime() {
        $inputs.intervals = {
            start_time: selectedTime.start_time,
            end_time: selectedTime.end_time,
        };
    }
</script>

{#if availableTimes.availables}
    <select class="form-control" bind:value={selectedTime} on:change={()=>selectedAvailableTime()}>
        <option value="">--</option>
        {#each availableTimes.availables as available}
            <option value={available}>{available.interval}</option>
        {/each}
    </select>

{/if}


<script>
    import {createEventDispatcher} from "svelte";
    import AppointmentsCount from "../../../admin/layout/calendar-actions/AppointmentsCount.svelte";
    import {inputs} from "../../../../services/form";

    const dispatch = createEventDispatcher();

    export let days = [];
    export let appointmentsCount;
    let className = "";
    export {className as class};

    function selected_day(day) {
        if (day.isValid) dispatch("click", day);
    }

    function getAppointmentsCount(date) {
        return appointmentsCount.find(
            (appointment) => appointment.date === date
        )?.count;
    }
</script>

{#if days.length > 0}
    {#each days as day}
        <div class="day" class:invalid={!day.isValid} class:greater-than={day.isGreaterThanToday}
             class:today={day.isToday}
             class:selected={$inputs.date === day.date}>
            <button
                type="button"
                class={className}
                on:click={() => selected_day(day)} disabled={!day.isValid}>
                {day.number}
                {#if appointmentsCount && day.isValid}
                    <AppointmentsCount count={getAppointmentsCount(day.date)}/>
                {/if}
            </button>
        </div>
    {/each}
{:else}
    <span>Buscando...</span>
{/if}

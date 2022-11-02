<script>
    import { createEventDispatcher } from "svelte";
    import AppointmentsCount from "./AppointmentsCount.svelte";
    const dispatch = createEventDispatcher();

    export let days = [];
    export let appointmentsCount;
    let className = "";
    export { className as class };

    function selected_day(day) {
        dispatch("click", day);
    }

    function getAppointmentsCount(date) {
        // Filter appointmenstCount
        return appointmentsCount.find(
            (appointment) => appointment.date === date
        )?.count;
    }
</script>

{#if days.length > 0}
    {#each days as day}
        <div
            class:disabled-item={!day.isValid}
            class="w-full bg-white text-gray-600 {className}"
        >
            <div class="text-center h-full" class:justify-between={day.isValid}>
                <button
                    type="button"
                    class="w-full h-full"
                    class:cursor-default={!day.isValid}
                    class:current-date={day.isToday}
                    on:click={() => selected_day(day)}
                >
                    {day.number}
                    {#if appointmentsCount && day.isValid}
                        <AppointmentsCount
                            count={getAppointmentsCount(day.date)}
                        />
                    {/if}
                </button>
            </div>
        </div>
    {/each}
{:else}
    <span>Buscando...</span>
{/if}

<style>
    .current-date {
        @apply text-red-700;
    }

    .disabled-item {
        @apply bg-gray-200 text-gray-400;
    }
</style>

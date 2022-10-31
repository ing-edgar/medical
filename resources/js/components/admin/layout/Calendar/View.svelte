<script>
    import { createEventDispatcher } from "svelte";
    const dispatch = createEventDispatcher();

    export let days = [];
    let className = "";
    export { className as class };
    function selected_day(day) {
        dispatch("click", day);
    }
</script>

{#if days.length > 0}
    {#each days as day}
        <div
            class:disabled-item={!day.isValid}
            class="w-full bg-white text-gray-600 {className}"
        >
            <div class="text-center">
                <div class="relative" class:justify-between={day.isValid}>
                    <button
                        type="button"
                        class="w-full"
                        class:cursor-default={!day.isValid}
                        class:current-date={day.isToday}
                        on:click={() => selected_day(day)}
                        >{day.number}
                    </button>
                </div>
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

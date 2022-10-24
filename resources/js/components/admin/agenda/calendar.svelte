<script>
    import { onMount } from "svelte";
    import CalendarActions from "./calendar_actions.svelte";
    let days = [];

    onMount(() => {});
</script>

<div class="p-2">
    <CalendarActions bind:days />
    <div class="grid grid-cols-7  text-center border border-gray-400 gap-px bg-gray-400">
        <div class="p-2 bg-white text-gray-600 font-semibold">Domingo</div>
        <div class="p-2 bg-white text-gray-600 font-semibold">Lunes</div>
        <div class="p-2 bg-white text-gray-600 font-semibold">Martes</div>
        <div class="p-2 bg-white text-gray-600 font-semibold">Miércoles</div>
        <div class="p-2 bg-white text-gray-600 font-semibold">Jueves</div>
        <div class="p-2 bg-white text-gray-600 font-semibold">Viernes</div>
        <div class="p-2 bg-white text-gray-600 font-semibold">Sábado</div>
        {#if days.length > 0}
            {#each days as day}
                <div
                    class:disabled-item={!day.isValid}
                    class="p-3 w-full text-sm bg-white text-gray-600"
                >
                    <div class="text-center">
                        <div
                            class="relative"
                            class:justify-between={day.isValid}
                        >
                            <span class:current-date={day.isToday}
                                >{day.number}</span
                            >
                        </div>
                    </div>
                </div>
            {/each}
        {:else}
            <span>Buscando...</span>
        {/if}
    </div>
</div>

<style>
    .current-date {
        @apply rounded-full bg-sky-500 px-2 py-1.5 text-white;
    }

    .disabled-item {
        @apply bg-gray-200 text-gray-400;
    }
</style>

<script>
    import { onMount } from "svelte";
    import Counter from "./Counter.svelte";
    import View from "./View.svelte";
    let days = [];
    let className = "";
    export let appointmentsCount;
    export { className as class };

    export let weekdays = [
        "Domingo",
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sábado",
    ];
    onMount(() => {});
</script>

<div class="bg-white">
    <Counter bind:days />
    <div
        class="grid grid-cols-7  text-center border border-gray-400 gap-px bg-gray-400"
    >
        {#each weekdays as weekday}
            <div class="p-2 bg-white text-gray-600 font-semibold">
                {weekday}
            </div>
        {/each}
        <View {days} class={className} {appointmentsCount} on:click/>
    </div>
</div>

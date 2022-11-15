<script>
    import {onMount} from "svelte";
    import Month from "./Month.svelte";
    import Day from "./Day.svelte";

    let days = [];
    let className;
    export let appointmentsCount;
    export {className as class};

    export let weekdays = [
        "Domingo",
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sábado",
    ];
    onMount(() => {
    });
</script>

<Month bind:days/>
<div class="body">
    {#each weekdays as weekday}
        <div class="day {className}">
            {weekday}
        </div>
    {/each}
    <Day {days} class={className} {appointmentsCount} on:click/>
</div>

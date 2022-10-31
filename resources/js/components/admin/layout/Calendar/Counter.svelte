<script>
    import { onMount } from "svelte";
    import moment from "moment/moment";
    import "moment/locale/es";
    import { buildDays } from "../../../../services/calendar";
    import Fa from "svelte-fa/src/fa.svelte";
    import {
        faAngleLeft,
        faAngleRight,
    } from "@fortawesome/free-solid-svg-icons";

    export let days = [];
    let date;
    let currentDate = null;
    let month_name;
    let month_number;
    export let ranges_date;

    function nextMonth() {
        month_number += 1;
        if (month_number > 11) {
            month_number = 0;
            date.year(date.year() + 1, "Y");
        }
        date.month(month_number);
        getCalendar();
    }

    function prevMonth() {
        month_number -= 1;
        if (month_number < 0) {
            month_number = 11;
            date.year(date.year() - 1, "Y");
        }
        date.month(month_number);
        getCalendar();
    }

    function getCalendar() {
        const calendar = buildDays(date, currentDate);
        days = calendar.days;
        month_name = calendar.month_name + " " + calendar.year;
        // obtenemos todos los días válidos
        const valid_days = days.filter((element) => element.isValid);
        // Extraemos solo la primer y última fecha
        ranges_date = {
            start_date: valid_days[0].date,
            last_date: valid_days[valid_days.length - 1].date,
        };
    }

    onMount(() => {
        currentDate = moment();
        month_number = currentDate.month(); // Número del mes actual
        date = currentDate.clone().month(month_number); // Clonar la fecha actual para que sea dinámica y se pueda mover por el calendario.
        getCalendar();
    });
</script>

<div class="flex justify-center items-center border-t border-l  border-r border-gray-400 p-2">
    <button class="text-sky-600 px-2" on:click={prevMonth}>
        <Fa icon={faAngleLeft} />
    </button>
    {#if date}
        <h1 class="font-semibold text-center text-lg capitalize">
            {month_name}
        </h1>
    {/if}
    <button class="text-sky-600 px-2" on:click={nextMonth}>
        <Fa icon={faAngleRight} />
    </button>
</div>

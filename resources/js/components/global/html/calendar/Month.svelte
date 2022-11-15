<script>
    import {onMount} from "svelte";
    import moment from "moment/moment";
    import "moment/locale/es";
    import {buildDays} from "@/services/calendar";
    import {faAngleLeft, faAngleRight} from "@fortawesome/free-solid-svg-icons";
    import CircleButton from "@/components/admin/html/interactions/CircleButton.svelte";
    import {inputs} from "@/services/form";

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
        date = currentDate.clone().month(month_number);
        if ($inputs.date) {
            date = moment($inputs.date);
            month_number = date.month();
        }
        getCalendar();
    });
</script>

<div class="months">
    <CircleButton class="circle-button text-save" icon={faAngleLeft} on:click={prevMonth}>
    </CircleButton>
    {#if date}
        <h1>
            {month_name}
        </h1>
    {/if}
    <CircleButton class="circle-button text-save bright" icon={faAngleRight} on:click={nextMonth}>
    </CircleButton>
</div>

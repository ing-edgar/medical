<script>
    import {faCalendarAlt} from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import {view} from "@/services/view";
    import Calendar from "../../global/html/calendar/Calendar.svelte";

    let weekdays = ["Do", "Lu", "Ma", "Mie", "Ju", "Vi", "Sa"];

    import {inputs} from "../../../services/form";
    import AvailableTime from "@/components/admin/appointments/AvailableTime.svelte";

    let open = false;

    function selectedDate(event) {
        open = false;
        if (!$inputs.professional_id) {
            alert("Seleccione un profesional");
            return;
        }
        $inputs.date = event.detail.date;
    }
</script>

<div class="opening-hours">
    <div class="form-group">
        <label for="" class="block">Seleccione una fecha</label>
        <div class="form-control" disabled>{$inputs.date ?? 'aaaa-mm-dd'}</div>
        <button on:click={()=>open=!open}>
            <Fa icon={faCalendarAlt}></Fa>
        </button>
        {#if open}
            <div class="calendar calendar-mini">
                <Calendar class="day-mini" {weekdays} on:click={selectedDate}/>
            </div>
        {/if}
    </div>
    {#if $inputs.date}
        <div class="form-group">
            <label>Seleccione una hora</label>
            <AvailableTime></AvailableTime>
        </div>
    {/if}
</div>

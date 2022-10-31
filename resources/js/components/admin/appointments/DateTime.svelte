<script>
    import { faCalendarAlt } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import Button from "../layout/Button.svelte";
    import { view } from "../../../services/view";
    import Base from "../layout/Calendar/Base.svelte";
    let weekdays = ["Do", "Lu", "Ma", "Mie", "Ju", "Vi", "Sa"];

    import { inputs } from "../../../services/form";
    let open = false;

    function selectedDate(event) {
        if (!$inputs.professional_id) {
            alert("Seleccione un profesional");
            return;
        }
        $inputs.date = event.detail.date;
        $view.component = "AvailableTime";
    }
</script>

<div>
    <label for="" class="block">¿Cuándo quiere la cita?</label>
    <span class="text-sm text-gray-700 italic"
        >Seleccione una fecha para buscar el horario disponible</span
    >
    <div class="relative">
        <div class="flex">
            <Button
                class="bg-sky-600 text-white"
                on:click={() => (open = !open)}
            >
                <Fa icon={faCalendarAlt} /> <span>Seleccione fecha</span>
            </Button>
            <div
                class="border border-gray-400 rounded-md ml-2 w-1/2 
            text-gray-400 align-middle p-2 bg-gray-200"
            >
                <span>aaaa-mm-dd</span>
            </div>
        </div>
        {#if open}
            <div class="absolute text-xs bottom-11 left-0 p-0">
                <Base {weekdays} class="p-1" on:click={selectedDate} />
            </div>
        {/if}
    </div>
</div>

<script>
    import { faAngleLeft } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import ToolbarModal from "../layout/ToolbarModal.svelte";
    import { view } from "../../../services/view";
    import { onMount } from "svelte";
    import { getAvailableTime } from "../../../api/user";
    import { inputs } from "../../../services/form";
    import moment from "moment/moment";

    let availableTimes = {};
    let date;
    onMount(() => getAvailable());

    async function getAvailable() {
        date = moment($inputs.date).locale("es").format("LL");

        const response = await getAvailableTime(
            $inputs.professional_id,
            $inputs.date
        );
        if (response.status == 200) {
            availableTimes = response.data;
        }
    }

    function selectedAvailableTime(interval) {
        $inputs.intervals = {
            start_time: interval.start_time,
            end_time: interval.end_time,
        };
        $view.component = "AppointmentsCreate";
    }
</script>

<ToolbarModal>
    <button
        slot="left-actions"
        class="text-blue-600 flex items-center"
        on:click={() => ($view.component = "AppointmentsCreate")}
    >
        <Fa icon={faAngleLeft} /> <span>Atrás</span>
    </button>
    <h1 slot="modal-title">Horario disponible</h1>
    <div slot="right-actions" />
</ToolbarModal>
<h3 class="mt-4 text-start font-bold italic">{date}</h3>
{#if availableTimes.availables}
    <div class="max-h-96 overflow-y-auto text-start mt-4">
        {#each availableTimes.availables as available}
            <div class="p-2 grid grid-cols-2 items-center">
                <span>{available.interval}</span>
                <button
                    class="border bg-green-600 p-2 text-white"
                    on:click={() => selectedAvailableTime(available)}
                >
                    Escoger
                </button>
            </div>
        {/each}
    </div>
{/if}

<script>
    import { faAngleLeft } from "@fortawesome/free-solid-svg-icons";
    import { getAvailableTime } from "../../../api/user";
    import { inputs } from "../../../services/form";
    import { view } from "../../../services/view";
    import Fa from "svelte-fa/src/fa.svelte";
    import { onMount } from "svelte";
    import moment from "moment/moment";
    import Modal from "../html/modal/Modal.svelte";
    import CircleButton from "../html/interactions/CircleButton.svelte";

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

<Modal>
    <div slot="left">
        <CircleButton
            icon={faAngleLeft}
            class="text-blue-400"
            on:click={() => ($view.component = "AppointmentsCreate")}
        />
    </div>
    <h1 slot="title">Horario disponible</h1>
    <div slot="right" />
    <section>
        <h3 class="mt-4 text-start font-bold italic">{date}</h3>
        {#if availableTimes.availables}
            <div class="mt-4">
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
    </section>
</Modal>

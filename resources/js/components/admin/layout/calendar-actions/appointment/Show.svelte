<script>
    import CircleButton from "../../../html/interactions/CircleButton.svelte";
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import {view} from "../../../../../services/view";
    import {
        faXmark,
        faAngleLeft,
        faPhone,
        faEnvelope,
        faIdCard,
    } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import Button from "../../../html/interactions/Button.svelte";
    import {changeStatus} from "../../../../../api/appointment";
    import BackAndCloseToolbar from "@/components/global/html/modal/BackAndCloseToolbar.svelte";

    let {patient, appointment_status, payment_status, id} =
        $view.data.appointment;

    function saveStatus(route_name) {
        changeStatus(id, route_name)
            .then((response) => {
                appointment_status = response.data[1].appointment_status;
                payment_status = response.data[1].payment_status;
            })
            .catch((error) => console.log(error));
    }
</script>

<Modal>
    <BackAndCloseToolbar slot="toolbar" backComponent="OpeningHourModal">
        <h1 slot="title">
            Cita programada de {patient.name}
        </h1>
    </BackAndCloseToolbar>

    <section class="">
        <div class="flex space-x-2 items-center">
            <Fa icon={faIdCard} class="text-gray-600"/>
            <span>{patient.rfc}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <Fa icon={faPhone} class="text-gray-600"/>
            <span>{patient.phone}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <Fa icon={faEnvelope} class="text-gray-600"/>
            <span>{patient.email}</span>
        </div>
    </section>
    <div class="space-y-2">
        <div class="flex space-x-2">
            <h1 class="text-md font-bold uppercase">Estado de la cita</h1>
            <span
                class="px-2 rounded-full {appointment_status.color}
            flex-start"
            >
                {appointment_status.name}
            </span>
        </div>

        <div class="flex space-x-2">
            {#each appointment_status.transitions as transition}
                <Button on:click={() => saveStatus(transition.route)} class="btn">
                    {transition.name}
                </Button>
            {/each}
        </div>

        <div class="flex space-x-2">
            <h1 class="text-md font-bold uppercase">Estado de pago</h1>
            <span class="px-2 rounded-full {payment_status.color}">
                {payment_status.name}
            </span>
        </div>

        <div class="flex space-x-2">
            {#each payment_status.transitions as transition}
                <Button on:click={() => saveStatus(transition.route)} class="btn">
                    {transition.name}
                </Button>
            {/each}
        </div>
    </div>
</Modal>

<style>
    .registered {
        @apply bg-yellow-600 text-white;
    }

    .confirmed {
        @apply bg-purple-600 text-white;
    }

    .canceled {
        @apply bg-red-600 text-white;
    }

    .completed {
        @apply bg-green-600 text-white;
    }
</style>

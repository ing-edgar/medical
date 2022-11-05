<script>
    import CircleButton from "../../../html/interactions/CircleButton.svelte";
    import Modal from "../../../html/modal/Modal.svelte";
    import { view } from "../../../../../services/view";
    import {
        faXmark,
        faAngleLeft,
        faPhone,
        faEnvelope,
        faIdCard,
    } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import Button from "../../../html/interactions/Button.svelte";
    import {
        registerStatus,
        cancelStatus,
        completeStatus,
        confirmStatus,
    } from "../../../../../api/appointment";
    const { patient } = $view.data.appointment;

    console.log($view.data.appointment);

    function confirm() {
        confirmStatus($view.data.appointment.id);
    }
    function cancel() {
        cancelStatus($view.data.appointment.id);
    }
    function register() {
        registerStatus($view.data.appointment.id);
    }
    function complete() {
        completeStatus($view.data.appointment.id);
    }
</script>

<Modal>
    <div slot="left" class="flex space-x-1">
        <CircleButton
            class="text-blue-400"
            icon={faAngleLeft}
            on:click={() => ($view.component = "OpeningHourModal")}
        />
        <CircleButton
            class="text-red-400"
            icon={faXmark}
            on:click={() => ($view.component = null)}
        />
    </div>

    <h1 slot="title">
        Cita programada de {patient.name}
    </h1>
    <div slot="right" />
    <section class="">
        <div class="flex space-x-2 items-center">
            <Fa icon={faIdCard} class="text-gray-600" />
            <span>{patient.rfc}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <Fa icon={faPhone} class="text-gray-600" />
            <span>{patient.phone}</span>
        </div>
        <div class="flex space-x-2 items-center">
            <Fa icon={faEnvelope} class="text-gray-600" />
            <span>{patient.email}</span>
        </div>
    </section>
    <div class="flex space-x-2">
        <Button on:click={confirm}>Confirmar</Button>
        <Button on:click={cancel}>Cancelar</Button>
        <Button on:click={register}>Registrar</Button>
        <Button on:click={complete}>Completar</Button>
    </div>
</Modal>

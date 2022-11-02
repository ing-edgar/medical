<script>
    import CircleButton from "../../../html/interactions/CircleButton.svelte";
    import Modal from "../../../html/modal/Modal.svelte";
    import { view } from "../../../../../services/view";
    import {
        faXmark,
        faAngleLeft,
        faPhone,
        faEnvelope,
        faIdCard
    } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";

    const { patient } = $view.data.appointment;
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
    <section slot="body" class="">
        <div class="flex space-x-2 items-center">
            <Fa icon={faIdCard} class="text-gray-600"/>
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
</Modal>

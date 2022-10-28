<script>
    import {
        faAngleLeft,
        
    } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import ToolbarModal from "../layout/ToolbarModal.svelte";
    import { view } from "../../../services/view";
    import { onMount } from "svelte";

    onMount(() => getAvailableTime());

    function getAvailableTime() {}
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



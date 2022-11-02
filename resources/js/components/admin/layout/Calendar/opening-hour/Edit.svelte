<script>
    import CircleButton from "../../../html/interactions/CircleButton.svelte";
    import Modal from "../../../html/modal/Modal.svelte";
    import { view } from "../../../../../services/view";
    import moment from "moment/moment";
    import {
        faXmark,
        faSave,
        faAngleLeft,
    } from "@fortawesome/free-solid-svg-icons";
    
    function getDate() {
        return moment($view.data.date).format("LL");
    }
</script>

<Modal>
    <div slot="left" class="flex space-x-1">
        <CircleButton
            class="text-blue-400"
            icon={faAngleLeft}
            on:click={() => ($view.component = 'OpeningHourModal')}
        />
        <CircleButton
            class="text-red-400"
            icon={faXmark}
            on:click={() => ($view.component = null)}
        />
    </div>
    <h1 slot="title">Editar horario laboral: {getDate()}</h1>
    <div slot="right">
        <CircleButton
            slot="right-actions"
            class="text-green-400"
            icon={faSave}
        />
    </div>
    <section slot="body">Migrando la funcionalidad</section>
</Modal>

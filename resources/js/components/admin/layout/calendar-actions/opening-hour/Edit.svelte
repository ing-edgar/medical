<script>
    import CircleButton from "../../../html/interactions/CircleButton.svelte";
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import {view} from "../../../../../services/view";
    import moment from "moment/moment";
    import {
        faXmark,
        faSave,
        faAngleLeft,
    } from "@fortawesome/free-solid-svg-icons";
    import BackAndCloseToolbar from "@/components/global/html/modal/BackAndCloseToolbar.svelte";

    function getDate() {
        return moment($view.data.date).format("LL");
    }
</script>

<Modal>
    <BackAndCloseToolbar slot="toolbar" backComponent="OpeningHourModal">
        <h1 slot="title">Editar horario laboral: {getDate()}</h1>
        <CircleButton
            class="circle-button text-save"
            icon={faSave}
        />
    </BackAndCloseToolbar>
    <section>Migrando la funcionalidad d</section>
</Modal>

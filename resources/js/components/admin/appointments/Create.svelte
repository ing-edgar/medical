<script>
    import {faXmark, faSave} from "@fortawesome/free-solid-svg-icons";
    import {getProfessionals} from "@/api/user";
    import {save} from "@/api/appointment";
    import {inputs} from "@/services/form";
    import DateTime from "./DateTime.svelte";
    import Inputs from "./Inputs.svelte";
    import {onMount} from "svelte";
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import CircleButton from "../html/interactions/CircleButton.svelte";
    import CloseToolbar from "@/components/global/html/modal/CloseToolbar.svelte";
    import Form from "@/components/global/html/forms/Form.svelte";
    import ModalMessages from "@/components/global/html/messages/ModalMessages.svelte";

    let message = '';

    function store() {
        open = true;
        message = "¿Estás seguro que deseas registrar la cita?";
    }

    function accept() {
        open = false;
        save($inputs);
    }

    function closing() {
        open = false;
    }

    let professionals = [];
    let open;
    onMount(() => getProfessionalsUser());

    async function getProfessionalsUser() {
        const response = await getProfessionals();
        if (response.status === 200) professionals = response.data;
    }
</script>

<Modal>
    <CloseToolbar slot="toolbar">
        <h1 slot="title">Crear una nueva cita</h1>
        <CircleButton
            icon={faSave}
            class="circle-button text-save"
            on:click={store}
        />
    </CloseToolbar>
    <Form>
        <Inputs {professionals}/>
        <DateTime/>
    </Form>
    {#if open}
        <ModalMessages {message} on:accept={accept} on:closing={closing}></ModalMessages>
    {/if}
</Modal>

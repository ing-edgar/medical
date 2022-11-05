<script>
    import { faXmark, faSave } from "@fortawesome/free-solid-svg-icons";
    import { getProfessionals } from "../../../api/user";
    import Messages from "../layout/Messages.svelte";
    import { save } from "../../../api/appointment";
    import { inputs } from "../../../services/form";
    import { view } from "../../../services/view";
    import Fa from "svelte-fa/src/fa.svelte";
    import DateTime from "./DateTime.svelte";
    import Inputs from "./Inputs.svelte";
    import { onMount } from "svelte";
    import Modal from "../html/modal/Modal.svelte";
    import CircleButton from "../html/interactions/CircleButton.svelte";

    function store() {
        const response = save($inputs);
        response
            .then((response) => {
                window.location.href = response.data.url;
            })
            .catch((error) => {
                console.log(error);
                request.status = error.status;
                request.message = "Por favor, corrige los siguientes errores";
                request.data = Object.entries(error.data.errors);
            });
    }
    let professionals = [];
    let request = {
        status: 0,
        message: null,
        data: [],
    };
    onMount(() => getProfessionalsUser());

    async function getProfessionalsUser() {
        const response = await getProfessionals();
        if (response.status === 200) professionals = response.data;
    }
</script>

<Modal>
    <div slot="left">
        <CircleButton
            class="text-red-400 flex items-center"
            icon={faXmark}
            on:click={() => ($view.component = null)}
        />
    </div>
    <h1 slot="title">Crear nueva cita</h1>
    <div slot="right">
        <CircleButton class="text-green-400" icon={faSave} on:click={store} />
    </div>

    <section
        class="text-start text-gray-600 pt-4 space-y-3 px-2"
    >
        <Messages {request} />
        <Inputs {professionals} />
        <DateTime />
    </section>
</Modal>

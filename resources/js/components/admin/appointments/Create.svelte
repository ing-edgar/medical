<script>
    import { faXmark, faSave } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import ToolbarModal from "../layout/ToolbarModal.svelte";
    import { view } from "../../../services/view";
    import DateTime from "./DateTime.svelte";
    import Inputs from "./Inputs.svelte";
    import { getProfessionals } from "../../../api/user";
    import { save } from "../../../api/appointment";
    import { inputs } from "../../../services/form";
    import { onMount } from "svelte";
    import Messages from "../layout/Messages.svelte";

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

<ToolbarModal>
    <button
        slot="left-actions"
        class="text-blue-600 flex items-center"
        on:click={() => ($view.component = null)}
    >
        <Fa icon={faXmark} />
    </button>
    <h1 slot="modal-title">Crear nueva cita</h1>
    <div slot="right-actions">
        <button class="text-blue-600" on:click={store}>
            <Fa icon={faSave} />
        </button>
    </div>
</ToolbarModal>

<section
    class="text-start text-gray-600 pt-4 
    space-y-3 px-2 max-h-96 overflow-y-auto"
>
    <Messages {request} />
    <Inputs {professionals} />
    <DateTime />
</section>

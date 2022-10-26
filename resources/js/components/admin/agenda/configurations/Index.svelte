<script>
    import Fa from "svelte-fa/src/fa.svelte";
    import Modal from "../../layout/Modal.svelte";
    import ToolbarModal from "../../layout/ToolbarModal.svelte";
    import { faXmark, faSave } from "@fortawesome/free-solid-svg-icons";
    import { createEventDispatcher, onMount } from "svelte";
    import { list, save } from "../../../../api/configuration";
    import Select from "../../layout/Select.svelte";
    import Messages from "../../layout/Messages.svelte";

    const dispatch = createEventDispatcher();

    let configuration = {
        user_id: 0,
        configurations: [],
    };
    let request = {};

    function click(componentName, open) {
        dispatch("click", {
            open,
            componentName,
        });
    }

    onMount(() => getConfigurations());

    async function getConfigurations() {
        const response = await list();

        let { id, configurations } = response.data.config_user;
        let types = response.data.configuration_types;
        configuration.user_id = id;
        configuration.configurations = buildConfigurations(
            types,
            configurations
        );
    }

    function buildConfigurations(types, configurations) {
        return types.map((type) => {
            let value = "-1";
            console.log(type.id);
            if (configurations.length > 0) {
                value = configurations.find(
                    (element) => element.pivot.config_type_id === type.id
                );

                value = parseInt(value.pivot.value);
            }

            return {
                id: type.id,
                label: type.label,
                input_type: type.input_type,
                value: value,
            };
        });
    }

    function saving() {
        const response = save(configuration);
        response
            .then((response) => {
                request.status = response.status;
                request.message = response.data;
            })
            .catch((error) => {
                request.status = response.status;
                request.message = "Por favor, corrige los siguientes errores";
                request.data = Object.entries(error.data.errors);
            });
    }
</script>

<Modal>
    <ToolbarModal>
        <button
            class="text-sky-600"
            slot="left-actions"
            on:click={() => click(null, false)}
        >
            <Fa icon={faXmark} />
        </button>
        <div slot="modal-title">Configuración</div>
        <button slot="right-actions" class="text-sky-600" on:click={saving}>
            <Fa icon={faSave} />
        </button>
    </ToolbarModal>
    <div class="py-2">
        <Messages {request} />
    </div>
    <div class="flex p-2">
        {#each configuration.configurations as config}
            <div>
                <label for="" class="block font-bold">{config.label}</label>
                <Select bind:value={config.value} />
            </div>
        {/each}
    </div>
</Modal>

<script>
    import { faXmark, faSave } from "@fortawesome/free-solid-svg-icons";
    import Select from "../../html/interactions/Select.svelte";
    import { list, save } from "../../../../api/configuration";
    import { onMount } from "svelte";
    import Messages from "../../layout/Messages.svelte";
    import { view } from "../../../../services/view";
    import Modal from "../../html/modal/Modal.svelte";
    import CircleButton from "../../html/interactions/CircleButton.svelte";

    let configuration = {
        user_id: 0,
        configurations: [],
    };

    let request = {};

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
            console.log(configurations);
            if (configurations.length > 0) {
                value = configurations.find(
                    (element) => element.pivot.config_type_id === type.id
                );
                if (value) {
                    value = parseInt(value.pivot.value);
                }
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
    <div slot="left" class="flex items-center">
        <CircleButton
            class="text-red-400"
            icon={faXmark}
            on:click={() => ($view.component = null)}
        />
    </div>
    <h1 slot="title">Configuración</h1>
    <div slot="right" class="flex items-center">
        <CircleButton class="text-green-400" icon={faSave} on:click={saving} />
    </div>

    <section slot="body">
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
    </section>
</Modal>

<script>
    import {faXmark, faSave} from "@fortawesome/free-solid-svg-icons";
    import Select from "../../html/interactions/Select.svelte";
    import {list, save} from "../../../../api/configuration";
    import {onMount} from "svelte";
    import Messages from "../../../global/html/forms/Messages.svelte";
    import {view} from "../../../../services/view";
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import CircleButton from "../../html/interactions/CircleButton.svelte";
    import CloseToolbar from "@/components/global/html/modal/CloseToolbar.svelte";
    import Form from "@/components/global/html/forms/Form.svelte";

    let configuration = {
        user_id: 0,
        configurations: [],
    };

    let request = {};

    onMount(() => getConfigurations());

    async function getConfigurations() {
        const response = await list();

        let {id, configurations} = response.data.config_user;
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
        save(configuration);
    }
</script>

<Modal>
    <CloseToolbar slot="toolbar">
        <h1 slot="title">Configuración</h1>
        <CircleButton class="circle-button text-save" icon={faSave} on:click={saving}/>
    </CloseToolbar>
    <div slot="left" class="flex items-center">
        <CircleButton
            class="text-red-400"
            icon={faXmark}
            on:click={() => ($view.component = null)}
        />
    </div>
    <h1 slot="title">Configuración</h1>
    <div slot="right" class="flex items-center">

    </div>

    <Form>
        <div class="flex">
            {#each configuration.configurations as config}
                <div>
                    <label for="" class="block font-bold">{config.label}</label>
                    <Select bind:value={config.value}/>
                </div>
            {/each}
        </div>
    </Form>
</Modal>

<script>
    import { components } from "../../../../services/components";
    import Modal from "../../layout/Modal.svelte";
    import { onMount } from "svelte";
    export let open = false;
    let component = null;

    onMount(() => openComponent("ShowOpeningHours"));

    function openComponent(componentName) {
        click({
            detail: {
                componentName,
            },
        });
    }

    function click(event) {
        console.log(event);
        component = components.find(
            (component) => component.name === event.detail.componentName
        ).component;
    }
</script>

<Modal>
    <svelte:component this={component} on:click={click} />
</Modal>

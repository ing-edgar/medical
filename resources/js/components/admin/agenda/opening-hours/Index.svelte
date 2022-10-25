<script>
    import { components } from "../../../../services/components";
    import Modal from "../../layout/Modal.svelte";
    import { onMount, createEventDispatcher } from "svelte";
    let component = null;
    const dispatch = createEventDispatcher();
    onMount(() => openComponent("ShowOpeningHours"));

    function openComponent(componentName) {
        click({
            detail: {
                componentName,
            },
        });
    }

    function click(event) {
        if (!event.detail.componentName) {
            dispatch("click", {
                open: event.detail.open,
                componentName: event.detail.componentName,
            });

            return;
        }
        component = components.find(
            (component) => component.name === event.detail.componentName
        ).component;
    }
</script>

<Modal>
    <svelte:component this={component} on:click={click} />
</Modal>

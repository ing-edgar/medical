<script>
    import { components } from "../../../../services/components";
    import Modal from "../../layout/Modal.svelte";
    import { onMount } from "svelte";
    export let open = false;
    let component = null;

    onMount(() => openComponent("ShowOpeningHours"));

    function openComponent(componentName) {
        component = components.find(
            (component) => component.name === componentName
        ).component;
    }
</script>

{#if open}
    <Modal>
        <svelte:component this={component} on:click />
    </Modal>
{/if}

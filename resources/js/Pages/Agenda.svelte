<script>
    import ConfigMenu from "../components/admin/agenda/config-menu.svelte";
    import Base from "../components/admin/layout/Calendar/Base.svelte";
    import Main from "../components/admin/layout/Main.svelte";
    import { components } from "../services/components";
    let open = false;
    let component = null;

    function openLayout(event) {
        open = event.detail.open;
        if (!event.detail.componentName) return;
        component = components.find(
            (component) => component.name === event.detail.componentName
        ).component;
    }
</script>

<svelte:head>
    <title>Agenda</title>
</svelte:head>

<Main>
    <div slot="title">Agenda</div>
    <ConfigMenu on:click={openLayout} />
    <Base class="p-4" />
</Main>

{#if open}
    <svelte:component this={component} on:click={openLayout} />
{/if}

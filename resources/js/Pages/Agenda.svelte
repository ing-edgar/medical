<script>
    import Calendar from "../components/admin/agenda/calendar.svelte";
    import ConfigMenu from "../components/admin/agenda/config-menu.svelte";
    import Main from "../components/admin/layout/Main.svelte";
    import { components } from "../services/components";
    let open = false;
    let component = null;
    
    function openLayout(event) {
        open = event.detail.open;
        if (!(event.detail.componentName)) return;
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
    <Calendar />
</Main>

{#if open}
    <svelte:component this={component} {open} on:click={openLayout} />
{/if}

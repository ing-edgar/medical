<script>
    import ConfigMenu from "../components/admin/agenda/config-menu.svelte";
    import Base from "../components/admin/layout/Calendar/Base.svelte";
    import Main from "../components/admin/layout/Main.svelte";
    import { components } from "../services/components";
    import { getAppointmentsCount } from "../api/appointment";
    import { onMount } from "svelte";

    let open = false;
    let component = null;
    let appointmentsCount;
    function openLayout(event) {
        open = event.detail.open;
        if (!event.detail.componentName) return;
        component = components.find(
            (component) => component.name === event.detail.componentName
        ).component;
    }

    onMount(() => getAppointmentsCountList(1));

    async function getAppointmentsCountList(user_id) {
        const response = await getAppointmentsCount(user_id);
        if (response.status === 200) {
            appointmentsCount = response.data;
        }
    }
</script>

<svelte:head>
    <title>Agenda</title>
</svelte:head>

<Main>
    <div slot="title">Agenda</div>
    <ConfigMenu on:click={openLayout} />
    {#if appointmentsCount}
        <Base class="p-2" {appointmentsCount} />
    {/if}
</Main>

{#if open}
    <svelte:component this={component} on:click={openLayout} />
{/if}

<script>
    import ConfigMenu from "../components/admin/agenda/config-menu.svelte";
    import Base from "../components/admin/layout/Calendar/Base.svelte";
    import Main from "../components/admin/layout/Main.svelte";
    import { getAppointmentsCount } from "../api/appointment";
    import { onMount } from "svelte";
    import Modal from "../components/admin/html/modal/Modal.svelte";
    import { component, view } from "../services/view";
    let appointmentsCount;

    onMount(() => getAppointmentsCountList(1));

    async function getAppointmentsCountList(user_id) {
        const response = await getAppointmentsCount(user_id);
        if (response.status === 200) {
            appointmentsCount = response.data;
        }
    }

    function selected_day(event) {
        console.log(event);
        $view.component = "OpeningHourModal";
        $view.data = event.detail;
    }
</script>

<svelte:head>
    <title>Agenda</title>
</svelte:head>

<Main>
    <div slot="title">Agenda</div>
    <ConfigMenu />
    {#if appointmentsCount}
        <Base class="p-2" {appointmentsCount} on:click={selected_day} />
    {/if}
</Main>
{#if $component}
    <svelte:component this={$component} />
{/if}

<script>
    import ConfigMenu from "../components/admin/agenda/config-menu.svelte";
    import Base from "../components/admin/layout/Calendar/Base.svelte";
    import Main from "../components/admin/layout/Main.svelte";
    import { getAppointmentsCount } from "../api/appointment";
    import { onMount } from "svelte";
    import Modal from "../components/admin/layout/Modal.svelte";
    import { component } from "../services/view";
    let appointmentsCount;

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
    <ConfigMenu />
    {#if appointmentsCount}
        <Base class="p-2" {appointmentsCount} />
    {/if}
</Main>
{#if $component}
    <Modal>
        <svelte:component this={$component} />
    </Modal>
{/if}

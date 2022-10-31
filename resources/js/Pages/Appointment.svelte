<script>
    import AppointmentsTable from "../components/admin/appointments/Table.svelte";
    import Main from "../components/admin/layout/Main.svelte";
    import Fa from "svelte-fa/src/fa.svelte";
    import { faPlus } from "@fortawesome/free-solid-svg-icons";
    import Button from "../components/admin/layout/Button.svelte";
    import { view, component } from "../services/view";
    import Modal from "../components/admin/layout/Modal.svelte";
    import { page } from "@inertiajs/inertia-svelte";
    export let appointments;

    function openView(component) {
        $view.component = component;
    }

    console.log($page.props);
</script>

<svelte:head>
    <title>Citas</title>
</svelte:head>
<Main>
    <div slot="title">Citas</div>
    {#if $page.props.flash.message}
        <div class="success">{$page.props.flash.message}</div>
    {/if}
    <section class="space-y-8">
        <Button
            class="text-white bg-sky-600"
            on:click={() => openView("AppointmentsCreate")}
        >
            <Fa icon={faPlus} />
            <span>Nueva cita</span>
        </Button>
        <AppointmentsTable {appointments} />
    </section>
</Main>

{#if $component}
    <Modal>
        <svelte:component this={$component} />
    </Modal>
{/if}

<style>
    .success {
        @apply bg-green-600 text-white p-2 my-4;
    }
</style>

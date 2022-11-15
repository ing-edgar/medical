<script>
    import AppointmentsTable from "../components/admin/appointments/Table.svelte";
    import Button from "../components/admin/html/interactions/Button.svelte";
    import {faPlus} from "@fortawesome/free-solid-svg-icons";
    import Main from "../components/admin/layout/Main.svelte";
    import {view, component} from "../services/view";
    import {page} from "@inertiajs/inertia-svelte";
    import Fa from "svelte-fa/src/fa.svelte";

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
    <section class="space-y-8">
        <Button
            class="btn btn-primary"
            on:click={() => openView("AppointmentsCreate")}
        >
            <Fa icon={faPlus}/>
            <span>Nueva cita</span>
        </Button>
        <AppointmentsTable {appointments}/>
    </section>
</Main>

{#if $component}
    <svelte:component this={$component}/>
{/if}

<style>
    .success {
        @apply bg-green-600 text-white p-2 my-4;
    }
</style>

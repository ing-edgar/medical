<script>
    import Fa from "svelte-fa/src/fa.svelte";
    import {
        faXmark,
        faPenSquare,
        faWrench,
    } from "@fortawesome/free-solid-svg-icons";
    import ToolbarModal from "../ToolbarModal.svelte";
    import { view } from "../../../../services/view";
    import { onMount } from "svelte";
    import { getAppointments } from "../../../../api/appointment";
    import moment from "moment/moment";
    import Table from "../Table.svelte";
    import TableHead from "../TableHead.svelte";
    import TableDataCell from "../TableDataCell.svelte";
    import Button from "../Button.svelte";
    let dateObject = null;
    let appointments = [];
    onMount(() => getAppointmentsList());

    async function getAppointmentsList() {
        dateObject = $view.data;
        const response = await getAppointments(dateObject.date, 1);
        if (response.status === 200) {
            appointments = response.data;
        }
    }

    function getDate() {
        return moment($view.data.date).format("LL");
    }
</script>

<ToolbarModal>
    <button
        class="text-sky-600"
        slot="left-actions"
        on:click={() => ($view.component = null)}
    >
        <Fa icon={faXmark} />
    </button>
    <div slot="modal-title">Calendario {getDate()}</div>
    <button slot="right-actions" class="text-sky-600">
        <Fa icon={faPenSquare} />
    </button>
</ToolbarModal>
<div class="text-start py-4">
    <Table>
        <tr slot="thead">
            <TableHead class="bg-green-200 text-start">Paciente</TableHead>
            <TableHead class="bg-green-200 text-start">Hora inicio</TableHead>
            <TableHead class="bg-green-200 text-start">Hora fin</TableHead>
            <TableHead class="bg-green-200 text-start"></TableHead>
            
        </tr>
        {#each appointments as appointment}
            <tr class="border-b">
                <TableDataCell class="text-start p-2">
                    {appointment.patient.name}
                </TableDataCell>
                <TableDataCell class="text-start  p-2">
                    {appointment.start_time}
                </TableDataCell>
                <TableDataCell class="text-start p-2">
                    {appointment.end_time}
                </TableDataCell>
                <TableDataCell class="text-start p-2">
                    <Button class="bg-green-600 text-white">
                        <Fa icon={faWrench} />
                    </Button>
                </TableDataCell>
            </tr>
        {/each}
    </Table>
</div>

<style>
    tr:nth-child(even) {
        @apply bg-gray-200;
    }
</style>

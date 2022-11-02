<script>
    import CircleButton from "../../html/interactions/CircleButton.svelte";
    import TableDataCell from "../../html/table/TableDataCell.svelte";
    import { getAppointments } from "../../../../api/appointment";
    import TableHead from "../../html/table/TableHead.svelte";
    import Table from "../../html/table/Table.svelte";
    import Modal from "../../html/modal/Modal.svelte";
    import { view } from "../../../../services/view";
    import moment from "moment/moment";
    import { onMount } from "svelte";
    import {
        faXmark,
        faPen,
        faWrench,
    } from "@fortawesome/free-solid-svg-icons";

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

    function selectedPatient(appointment) {
        console.log("hola mundo");
        $view.data.appointment = appointment;
        $view.component = "AppointmentEdit";
    }
</script>

<Modal>
    <div slot="left">
        <CircleButton
            class="text-red-300"
            icon={faXmark}
            on:click={() => ($view.component = null)}
        />
    </div>
    <h1 slot="title">Calendario {getDate()}</h1>
    <div slot="right">
        <CircleButton
            class="text-green-400"
            icon={faPen}
            on:click={() => ($view.component = "EditOpeningHour")}
        />
    </div>

    <div class="text-start py-1" slot="body">
        <h2 class="font-bold uppercase">Citas programadas</h2>
        <Table>
            <tr slot="thead">
                <TableHead class="bg-green-200 text-start">Paciente</TableHead>
                <TableHead class="bg-green-200 text-start"
                    >Hora inicio</TableHead
                >
                <TableHead class="bg-green-200 text-start">Hora fin</TableHead>
                <TableHead class="bg-green-200 text-start" />
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
                        <CircleButton
                            icon={faWrench}
                            class="bg-green-600 text-white"
                            on:click={() =>
                                selectedPatient(appointment)}
                        />
                    </TableDataCell>
                </tr>
            {/each}
        </Table>
    </div>
</Modal>

<style>
    tr:nth-child(even) {
        @apply bg-gray-200;
    }
</style>

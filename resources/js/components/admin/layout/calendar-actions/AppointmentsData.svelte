<script>
    import CircleButton from "../../html/interactions/CircleButton.svelte";
    import TableDataCell from "../../html/table/TableDataCell.svelte";
    import {getAppointments} from "../../../../api/appointment";
    import TableHead from "../../html/table/TableHead.svelte";
    import Table from "../../html/table/Table.svelte";
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import {view} from "../../../../services/view";
    import moment from "moment/moment";
    import {onMount} from "svelte";
    import {
        faXmark,
        faPen,
        faWrench,
    } from "@fortawesome/free-solid-svg-icons";
    import CloseToolbar from "@/components/global/html/modal/CloseToolbar.svelte";

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
        $view.data.appointment = appointment;
        $view.component = "AppointmentEdit";
    }
</script>

<Modal>
    <CloseToolbar slot="toolbar">
        <h1 slot="title">Calendario {getDate()}</h1>

        <CircleButton
            class="circle-button text-save"
            icon={faPen}
            on:click={() => ($view.component = "EditOpeningHour")}
        />
    </CloseToolbar>

    <div class="text-start py-1">
        <h2 class="font-bold uppercase">Citas programadas</h2>
        <Table>
            <tr slot="thead">
                <TableHead class="bg-green-200 text-start">Paciente</TableHead>
                <TableHead class="bg-green-200 text-start">
                    Hora inicio
                </TableHead>
                <TableHead class="bg-green-200 text-start">Hora fin</TableHead>
                <TableHead class="bg-green-200 text-start"/>
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
                            class="circle-button text-primary"
                            on:click={() => selectedPatient(appointment)}
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

<script>
    import TableDataCell from "../html/table/TableDataCell.svelte";
    import { faWrench } from "@fortawesome/free-solid-svg-icons";
    import Button from "../html/interactions/Button.svelte";
    import TableHead from "../html/table/TableHead.svelte";
    import Table from "../html/table/Table.svelte";
    import Fa from "svelte-fa/src/fa.svelte";

    export let appointments;
</script>

{#if appointments.length > 0}
    <Table>
        <tr slot="thead">
            <TableHead>ID cita</TableHead>
            <TableHead>Paciente</TableHead>
            <TableHead>Fecha</TableHead>
            <TableHead>Hora inicio</TableHead>
            <TableHead>Hora fin</TableHead>
            <TableHead>Estado cita</TableHead>
            <TableHead>Estado pago</TableHead>
            <TableHead>Profesional</TableHead>
            <TableHead />
        </tr>
        {#each appointments as appointment}
            <tr>
                <TableDataCell>{appointment.id}</TableDataCell>
                <TableDataCell>{appointment.patient.name}</TableDataCell>
                <TableDataCell>{appointment.date}</TableDataCell>
                <TableDataCell>{appointment.start_time}</TableDataCell>
                <TableDataCell>{appointment.end_time}</TableDataCell>
                <TableDataCell>
                    {appointment.appointment_status.name}
                </TableDataCell>
                <TableDataCell>
                    {appointment.payment_status.name}
                </TableDataCell>
                <TableDataCell>{appointment.user.name}</TableDataCell>
                <TableDataCell>
                    <Button class="bg-green-600 text-white">
                        <Fa icon={faWrench} /> <span>Administrar</span>
                    </Button>
                </TableDataCell>
            </tr>
        {/each}
    </Table>
{:else}
    <p>Sin citas</p>
{/if}

<style>
    tr:nth-child(even) {
        @apply bg-gray-200;
    }
</style>

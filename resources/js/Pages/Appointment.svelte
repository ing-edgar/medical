<script>
    import Main from "../components/admin/layout/Main.svelte";
    import Fa from "svelte-fa/src/fa.svelte";
    import { faEye } from "@fortawesome/free-solid-svg-icons";
    export let appointments;
</script>

<svelte:head><title>Citas</title></svelte:head>
<Main>
    <div slot="title">Citas</div>
    <section class="space-y-8">
        <button class="border bg-sky-600 text-white p-2  rounded-md">
            Nueva cita
        </button>
        {#if appointments.length > 0}
            <table class="table-auto w-full border rounded-md">
                <thead>
                    <tr>
                        <th class="text-gray-600 py-2 bg-gray-200">ID cita</th>
                        <th class="text-gray-600 py-2 bg-gray-200">Paciente</th>
                        <th class="text-gray-600 py-2 bg-gray-200">Fecha</th>
                        <th class="text-gray-600 py-2 bg-gray-200">
                            Hora inicio
                        </th>
                        <th class="text-gray-600 py-2 bg-gray-200">Hora fin</th>
                        <th class="text-gray-600 py-2 bg-gray-200">
                            Estado cita
                        </th>
                        <th class="text-gray-600 py-2 bg-gray-200">
                            Estado pago
                        </th>
                        <th class="text-gray-600 py-2 bg-gray-200"
                            >Profesional
                        </th>
                        <th class="text-gray-600 py-2 bg-gray-200">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {#each appointments as appointment}
                        <tr>
                            <td class="text-center py-2">{appointment.id}</td>
                            <td class="text-center py-2"
                                >{appointment.patient.name}</td
                            >
                            <td class="text-center py-2">{appointment.date}</td>
                            <td class="text-center py-2">
                                {appointment.start_time}
                            </td>
                            <td class="text-center py-2">
                                {appointment.end_time}
                            </td>
                            <td class="text-center py-2">
                                {appointment.appointment_status.name}
                            </td>
                            <td class="text-center py-2">
                                {appointment.payment_status.name}
                            </td>

                            <td class="text-center py-2"
                                >{appointment.user.name}</td
                            >
                            <td class="text-center py-2">
                                <button
                                    class="px-2 bg-green-700 
                                flex items-center text-white space-x-2 rounded-md"
                                >
                                    Administrar
                                </button>
                            </td>
                        </tr>
                    {/each}
                </tbody>
            </table>
        {:else}
            <p>Sin citas</p>
        {/if}
    </section>
</Main>

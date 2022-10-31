<script>
    import { inputs } from "../../../services/form";
    export let professionals;
</script>

<div>
    <label for="name" class="block">¿Para quién es la cita?</label>
    <input
        type="text"
        placeholder="Nombre del paciente"
        class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        bind:value={$inputs.name}
    />
</div>
<div>
    <label for="name" class="block">RFC</label>
    <input
        type="text"
        placeholder="Identificación del paciente"
        class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        bind:value={$inputs.rfc}
    />
</div>
<div>
    <label for="name" class="block">Teléfono</label>
    <input
        type="text"
        placeholder="Teléfono del paciente"
        class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        bind:value={$inputs.phone}
    />
</div>
<div>
    <label for="name" class="block">Correo electrónico</label>
    <input
        type="text"
        placeholder="Correo electrónico del paciente"
        class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        bind:value={$inputs.email}
    />
</div>
<div>
    <label for="professional" class="block">
        Seleccione el profesional que quieres que te atienda
    </label>
    <select
        name="professional"
        id="professional"
        class="border border-gray-500 rounded-md w-full p-2"
        bind:value={$inputs.professional_id}
    >
        <option value="">--</option>
        {#each professionals as professional}
            <option value={professional.id}>{professional.name}</option>
        {/each}
    </select>
</div>

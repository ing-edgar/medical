<script>
    import {inputs} from "../../../services/form";

    export let professionals;
</script>

<div class="form-group">
    <label for="name">¿Para quién es la cita?</label>
    <input bind:value={$inputs.name} class="form-control"/>
</div>
<div class="form-group">
    <label for="name">RFC</label>
    <input type="text" bind:value={$inputs.rfc} class="form-control"/>
</div>
<div class="form-group">
    <label for="name">Teléfono</label>
    <input type="text" bind:value={$inputs.phone} class="form-control"/>
</div>
<div class="form-group">
    <label for="name">Correo electrónico</label>
    <input type="text" bind:value={$inputs.email} class="form-control"/>
</div>
<div class="form-group">
    <label for="professional">
        Seleccione el profesional que quieres que te atienda
    </label>
    <select class="form-control" name="professional" bind:value={$inputs.professional_id}>
        <option value="">--</option>
        {#each professionals as professional}
            <option value={professional.id}>{professional.name}</option>
        {/each}
    </select>
</div>

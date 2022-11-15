<script>
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import Button from "@/components/admin/html/interactions/Button.svelte";
    import {createEventDispatcher} from "svelte";
    import TitleToolbar from "@/components/global/html/modal/TitleToolbar.svelte";

    const dispatch = createEventDispatcher();
    export let message = "";
</script>

<Modal>
    <TitleToolbar slot="toolbar">
        <h1 slot="title">Información</h1>
    </TitleToolbar>
    {message}
    <div class="flex space-x-2">
        <Button class="btn btn-primary" on:click={()=>dispatch('accept')}>Aceptar</Button>
        <Button class="btn btn-danger" on:click={()=>dispatch('closing')}>Cancelar</Button>
    </div>
</Modal>

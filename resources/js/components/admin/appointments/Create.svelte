<script>
    import {
        faXmark,
        faSave,
        faSearch,
        faCalendarAlt,
    } from "@fortawesome/free-solid-svg-icons";
    import Fa from "svelte-fa/src/fa.svelte";
    import ToolbarModal from "../layout/ToolbarModal.svelte";
    import { view } from "../../../services/view";
    import Button from "../layout/Button.svelte";

    function save() {}
</script>

<ToolbarModal>
    <button
        slot="left-actions"
        class="text-blue-600 flex items-center"
        on:click={() => ($view.component = null)}
    >
        <Fa icon={faXmark} />
    </button>
    <h1 slot="modal-title">Crear nueva cita</h1>
    <div slot="right-actions">
        <button class="text-blue-600" on:click={save}>
            <Fa icon={faSave} />
        </button>
    </div>
</ToolbarModal>

<section
    class="text-start text-gray-600 pt-4 
    space-y-3 px-2 max-h-96 overflow-y-auto"
>
    <div>
        <label for="name" class="block">¿Para quién es la cita?</label>
        <input
            type="text"
            placeholder="Nombre del paciente"
            class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        />
    </div>
    <div>
        <label for="name" class="block">RFC</label>
        <input
            type="text"
            placeholder="Identificación del paciente"
            class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        />
    </div>
    <div>
        <label for="name" class="block">Teléfono</label>
        <input
            type="text"
            placeholder="Teléfono del paciente"
            class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
        />
    </div>
    <div>
        <label for="name" class="block">Correo electrónico</label>
        <input
            type="text"
            placeholder="Correo electrónico del paciente"
            class="pl-2 pr-5 w-full border border-gray-400 rounded-md py-2"
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
        />
    </div>
    <div>
        <label for="" class="block">¿Cuándo quiere la cita?</label>
        <div class="flex">
            <Button
                class="bg-sky-600 text-white"
                on:click={() => ($view.component = "AvailableTime")}
            >
                <Fa icon={faCalendarAlt} /> <span>Seleccione fecha y hora</span>
            </Button>
            <div
                class="border border-gray-400 rounded-md ml-2 w-1/2 
                text-gray-400 align-middle p-2 bg-gray-200"
            >
                <span>aaaa-mm-dd</span>
            </div>
        </div>
    </div>
</section>

<script>
    import Fa from "svelte-fa/src/fa.svelte";
    import { faGear } from "@fortawesome/free-solid-svg-icons";
    import { createEventDispatcher } from "svelte";

    const dispatch = createEventDispatcher();

    function click(componentName, open) {
        dispatch("click", { componentName, open });
    }
    let open = false;
</script>

<div class="p-2 relative">
    <button
        class="bg-sky-500 flex items-center border p-2 rounded-md text-white space-x-1"
        on:click={() => (open = !open)}
    >
        <Fa icon={faGear} /> <span>Configuración</span>
    </button>

    {#if open}
        <div
            class="absolute left-1 top-14 border p-2 rounded-md text-sm w-40 bg-white "
        >
            <ul class="text-right">
                <li class="hover:bg-pink-100 p-2 rounded-full">
                    <a href={"#"} on:click={() => click("OpeningHoursIndex", true)}>
                        Horario de atención
                    </a>
                </li>
                <li class="hover:bg-pink-100 p-2 rounded-full">
                    <a href={"#"} on:click={() => click("ConfigurationForm", true)}>
                        Configuración
                    </a>
                </li>
            </ul>
        </div>
    {/if}
</div>

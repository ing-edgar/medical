<script>
    import ToolbarModal from "../../layout/ToolbarModal.svelte";
    import Fa from "svelte-fa/src/fa.svelte";
    import {
        faXmark,
        faPlus,
        faPenToSquare,
    } from "@fortawesome/free-solid-svg-icons";

    import {
        storeOpeningHours,
        list,
        findIndex,
    } from "../../../../api/opening_hours";
    import { view } from "../../../../services/view";
    import { onMount } from "svelte";

    // Es un arreglo que contiene objetos de los horarios de atención de
    // los días de la semana.
    let openingHours = [];

    onMount(() => getOpeningHours());

    async function getOpeningHours() {
        $storeOpeningHours = {
            selected_weekdays: [],
            openingHour: {},
        };
        const response = await list(1);

        if (response.status > 300) {
        }

        buildOfficeHour(response.data);
    }

    function buildOfficeHour(data) {
        data.forEach((day) => {
            // Se obtiene la jornada horaria por día
            const hours = JSON.parse(day.pivot.values ?? []);

            const openingHour = findOpeningHour(hours);

            $storeOpeningHours.selected_weekdays.push(day.id);

            if (!openingHour) {
                openingHours.push({
                    weekdays: [{ id: day.id, name: day.name }],
                    values: hours,
                });
            } else {
                openingHour.weekdays.push({
                    id: day.id,
                    name: day.name,
                });
            }
        });
        openingHours.sort(function (a, b) {
            return b.values.length - a.values.length;
        });
        openingHours = openingHours;
    }
    /**
     * Para no tener elementos duplicados buscamos si ya existe una día con la jornada
     * horaria dada
     *
     * @param hours
     */
    function findOpeningHour(hours) {
        let openingHoursTemp = JSON.parse(JSON.stringify(openingHours));
        let findedIndex = -1;
        for (let index = 0; index < openingHoursTemp.length; index++) {
            const openingHourTemp = openingHoursTemp[index];

            if (hours.length !== openingHourTemp?.values.length) {
                continue;
            }

            findedIndex = findIndex(hours, openingHourTemp, index);
            if (findedIndex > 0) {
                break;
            }
        }

        return openingHours[findedIndex];
    }

    function saveInStoreOpeningHoursObject(openingHour) {
        $storeOpeningHours.openingHour = openingHour;
        $view.component = "CreateOpeningHours";
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
    <div slot="modal-title">Horario de atención</div>
    <button
        slot="right-actions"
        class="text-sky-600"
        on:click={() => ($view.component = "CreateOpeningHours")}
    >
        <Fa icon={faPlus} />
    </button>
</ToolbarModal>
<div>
    {#each openingHours as openingHour}
        {#if openingHour.values.length > 0}
            <div class="text-xs md:text-base my-2 p-2">
                <div class="flex flex-wrap">
                    <p class="font-semibold">
                        {#each openingHour.weekdays as workday, index}
                            {#if index === openingHour.weekdays.length - 1 && openingHour.weekdays.length > 1}
                                &nbsp;y
                            {:else if index > 0}
                                ,
                            {/if}
                            {workday.name}
                        {/each}
                    </p>
                    <div class="px-2 text-blue-600">
                        <button
                            on:click={() =>
                                saveInStoreOpeningHoursObject(openingHour)}
                            ><Fa icon={faPenToSquare} /></button
                        >
                    </div>
                </div>

                {#each openingHour.values as value}
                    <div class="text-left">
                        {value.start_time} - {value.end_time}
                    </div>
                {/each}
            </div>
        {/if}
    {/each}
</div>

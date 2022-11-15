<script>
    import {onMount} from "svelte";
    import Intervals from "./Intervals.svelte";
    import {storeOpeningHours, save} from "@/api/opening_hours";
    import {getWeekdays} from "@/api/weekday";
    import moment from "moment/moment";
    import {faFloppyDisk, faPlus} from "@fortawesome/free-solid-svg-icons";
    import Modal from "@/components/global/html/modal/Modal.svelte";
    import CircleButton from "../../html/interactions/CircleButton.svelte";
    import BackToolbar from "@/components/global/html/modal/BackAndCloseToolbar.svelte";
    import Form from "@/components/global/html/forms/Form.svelte";

    let openingHours = {
        weekdays: [],
        selected_weekdays: [],
        deleted_weekdays: [],
        intervals: [],
    };

    let request = {};

    onMount(() => getWeekday());

    async function getWeekday() {
        const response = await getWeekdays();
        const openingHour = $storeOpeningHours.openingHour;
        // Son todos los días que no tienen un horario de atención
        openingHours.weekdays = findEmptyOpeningHours(response.data);
        // Si se ha de editar, debemos concatenar los días vacíos con los que actualmente tiene el grupo, junto
        // con sus intervalos
        if (openingHour.weekdays) {
            openingHours.selected_weekdays = getSelectedWeekdays(openingHour);
            openingHours.weekdays = openingHour.weekdays.concat(
                openingHours.weekdays
            );
            openingHours.intervals = openingHour.values;
        }
    }

    function getSelectedWeekdays(openingHour) {
        return $storeOpeningHours.selected_weekdays.filter((id) =>
            openingHour.weekdays.some((weekday) => weekday.id === id)
        );
    }

    function findEmptyOpeningHours(weekdays) {
        const storeWeekdays = $storeOpeningHours.selected_weekdays;
        console.log(storeWeekdays);

        return weekdays.filter((weekday) => {
            return !storeWeekdays.includes(weekday.id);
        });
    }

    function changed(event, weekday) {
        // Eliminamos o agregamos los identificadores que debemos actualizar
        if (event.target.checked) {
            openingHours.deleted_weekdays.filter(
                (element) => element !== weekday.id
            );
        } else {
            openingHours.deleted_weekdays.push(weekday.id);
        }
    }

    function removeEntry(index) {
        openingHours.intervals = openingHours.intervals.filter(
            (e, i) => i !== index
        );
    }

    function saveOpeningHours() {
        save({
            user_id: 1,
            openingHoursAttr: buildOpeningHours(),
            deleted_weekdays: openingHours.deleted_weekdays,
        });
    }

    function buildOpeningHours() {
        return openingHours.selected_weekdays.map((weekday_id) => {
            return {
                weekday_id,
                values: sort(),
            };
        });
    }

    function sort() {
        return openingHours.intervals.sort(function (a, b) {
            const aStartTime = moment(a.start_time, "h:mm:ss A");
            const aEndTime = moment(a.end_time, "h:mm:ss A");
            const bStartTime = moment(b.start_time, "h:mm:ss A");
            const bEndTime = moment(b.end_time, "h:mm:ss A");

            if (aStartTime < bStartTime && aEndTime < bEndTime) {
                return -1;
            }
            // Ordenamos el segundo como el primero
            if (aStartTime > bStartTime && aEndTime > bEndTime) {
                return 1;
            }

            return 0;
        });
    }

    function addNewEntry() {
        if (openingHours.selected_weekdays <= 0) {
            alert("Deberá escoger un día laboral");
            return;
        }

        openingHours.intervals.push({
            start_time: "8:00 AM",
            end_time: "12:00 PM",
        });
        openingHours.intervals = openingHours.intervals;
    }
</script>

<Modal>
    <BackToolbar slot="toolbar" backComponent="ShowOpeningHours">
        <h1 slot="title">Horario de atención</h1>
        {#if openingHours.intervals.length > 0}
            <CircleButton
                icon={faFloppyDisk}
                class="circle-button text-save"
                on:click={saveOpeningHours}
            />
        {/if}
        <CircleButton
            icon={faPlus}
            class="circle-button text-plus"
            on:click={addNewEntry}
            disabled={openingHours.selected_weekdays <= 0}></CircleButton>
    </BackToolbar>
    <Form>
        {#if openingHours.weekdays.length > 0}
            <div class="weekdays-list">
                {#each openingHours.weekdays as weekday}
                    <div>
                        <label for="workdays_id" class="block"
                        >{weekday.name}
                        </label>
                        <input
                            type="checkbox"
                            name="workdays_id"
                            id="workdays_id"
                            bind:group={openingHours.selected_weekdays}
                            on:change={(event) => changed(event, weekday)}
                            value={weekday.id}
                        />
                    </div>
                {/each}
            </div>
            <div id="intervals">
                {#each openingHours.intervals as interval, index}
                    <Intervals
                        {interval}
                        on:delete={() => removeEntry(index)}
                    />
                {/each}
            </div>
        {:else}
            <p>No hay días libres para asignar un horario de atención</p>
        {/if}
    </Form>
</Modal>+

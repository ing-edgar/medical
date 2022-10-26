import API from "../services/Api";
import { writable } from 'svelte/store';

export const storeOpeningHours = writable({
    selected_weekdays: [], //union ids
    openingHour: {} // Selected opening hour
});

// Método que permite obtener una colección de horarios de atención.
export const list = async (id) => {
    try {

        const response = await API.get(route('opening-hours.index', {
            user_id: id
        }));
        return response;
    } catch (error) {
        return error;
    }
}

// Método que permite guardar un horario de atención
export const save = async (values) => {
    try {

        const response = API.post(route('opening-hours.store'), {
            user_id: values.user_id,
            openingHours: values.openingHoursAttr,
            deleted_weekdays: values.deleted_weekdays,
        });
        return response;
    } catch (error) {
        return error;
    }
}

// Método que permite actualizar un horario de atención
export const update = async (values) => {

}

export const findIndex = (hours, openingHourTemp, openingHourTempIndex) => {
    let count = 0;
    for (let i = 0; i < hours.length; i++) {
        for (let h = 0; h < openingHourTemp?.values.length; h++) {
            const element = openingHourTemp.values[h];
            if (
                element.start_time === hours[i].start_time &&
                element.end_time === hours[i].end_time
            ) {
                count++;
                openingHourTemp.values.splice(h, 1);
                break;
            }
        }
    }

    if (count === hours.length) {
        return openingHourTempIndex;
    }

    return -1;
}
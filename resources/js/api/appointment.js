import API from "../services/Api";
import {request} from "@/services/request";
import {inputs} from "@/services/form";

// Método que permite obtener una colección de horarios de atención.
export const getProfessionals = async (id) => {
    try {

        const response = await API.get(route('opening-hours.index', {
            user_id: id
        }));
        return response;
    } catch (error) {
        return error;
    }
}

// Método que permite obtener una colección de horarios de atención.
export const save = (values) => {
    API.post(route('appointments.store'), {
        user_id: values.professional_id,
        date: values.date,
        intervals: values.intervals,
        patient_data: {
            name: values.name,
            rfc: values.rfc,
            phone: values.phone,
            email: values.email
        }
    }).then(res => {
        request.set({
            status: res.status,
            data: {
                message: res.data
            }
        });
        inputs.set({})
    }).catch(error => {
        console.log(error.data.errors)
        request.set({
            status: error.status,
            data: {
                message: 'Por favor, corrije los siguientes errores',
                errors: error.data.errors
            }
        })
    });

}

export const getAppointmentsCount = async (user_id) => {
    try {

        const response = API.get(route('appointments.count', {
            user_id: user_id
        }));
        return response;
    } catch (error) {
        return error;
    }
}

export const getAppointments = async (date, user_id) => {
    try {
        const response = API.get(route('appointments.list', {
            user_id: user_id,
            date: date
        }));
        return response;
    } catch (error) {
        return error;
    }
}
export const changeStatus = async (appointment_id, route_name) => {
    try {
        const response = API.patch(route(route_name, {
            uuid: appointment_id
        }));
        return response;
    } catch (error) {
        return error;
    }
}

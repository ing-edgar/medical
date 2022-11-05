import API from "../services/Api";

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
    try {

        const response = API.post(route('appointments.store'), {
            user_id: values.professional_id,
            date: values.date,
            intervals: values.intervals,
            patient_data: {
                name: values.name,
                rfc: values.rfc,
                phone: values.phone,
                email: values.email
            }
        });
        return response;
    } catch (error) {
        return error;
    }
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
export const confirmStatus = async (appointment_id) => {
    try {
        const response = API.patch(route('appointments-status.confirm', {
            uuid: appointment_id
        }));
        return response;
    } catch (error) {
        return error;
    }
}
export const completeStatus = async (appointment_id) => {
    try {
        const response = API.patch(route('appointments-status.complete', {
            uuid: appointment_id
        }));
        return response;
    } catch (error) {
        return error;
    }
}
export const cancelStatus = async (appointment_id) => {
    try {
        const response = API.patch(route('appointments-status.cancel', {
            uuid: appointment_id
        }));
        return response;
    } catch (error) {
        return error;
    }
}
export const registerStatus = async (appointment_id) => {
    try {
        const response = API.patch(route('appointments-status.register', {
            uuid: appointment_id
        }));
        return response;
    } catch (error) {
        return error;
    }
}

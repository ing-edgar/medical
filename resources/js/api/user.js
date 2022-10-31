import API from "../services/Api";

// Método que permite obtener una colección de horarios de atención.
export const getProfessionals = async () => {
    try {
        const response = await API.get(route('users.professionals'));
        return response;
    } catch (error) {
        return error;
    }
}


// Método que permite obtener una colección de horarios de atención.
export const getAvailableTime = async (professional_id, date) => {
    try {
        const response = await API.get(route('users.availableTimes', {
            user_id: professional_id,
            date: date
        }));
        return response;
    } catch (error) {
        return error;
    }
}
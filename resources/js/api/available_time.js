import API from "../services/Api";

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

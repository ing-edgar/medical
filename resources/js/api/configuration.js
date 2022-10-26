import API from "../services/Api";


// Método que permite obtener una colección de citas.
export const list = async (params) => {
    try {
        const response = await API.get(route('configurations.index', {
            user_id: 1,
        }))

        return response;
    } catch (err) {
        return err;
    }
}

// Método que permite guardar una cita
export const save = async (values) => {
    try {
        const response = await API.post(route('configurations.store'), {
            user_id: values.user_id,
            configurations: values.configurations

        });

        return response;
    } catch (err) {
        return err;
    }
}
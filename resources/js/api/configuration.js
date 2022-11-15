import API from "../services/Api";
import {inputs} from "@/services/form";
import {request} from "@/services/request";


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
export const save = (values) => {

    API.post(route('configurations.store'), {
        user_id: values.user_id,
        configurations: values.configurations

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

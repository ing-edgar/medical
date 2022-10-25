import API from "../services/Api";

export const getWeekdays = async () => {
    try {
        const response = await API.get(`weekdays`);
        return response;
    } catch (error) {
        return error;
    }
}
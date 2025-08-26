import axios from "axios";
const api = axios.create({
    baseURL:"http://127.0.0.1:8000/"
});

//get method
export const getBoxes = () => {
    return api.get("/box");
};

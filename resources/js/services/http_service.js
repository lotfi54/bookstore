import store from '../store'
import axios from 'axios'; 

export function http(){
    return axios.create({
        baseURL: store.state.apiUrl
    });
}

export function httpFile(){
    return axios.create({
        baseURL: store.state.apiUrl,
        headers:{
            'content-type':'multipart/form-dat'
        }
    });
}
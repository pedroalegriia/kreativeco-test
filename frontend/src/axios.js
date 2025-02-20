import axios from 'axios';

const instance = axios.create({
    baseURL: 'http://localhost:8000', // Cambia esto a la URL de tu API
});

instance.interceptors.request.use(config => {
    const token = localStorage.getItem('token');
    if (token) {
        config.headers['Authorization'] = `Bearer ${token}`;
    }
    return config;
}, error => {
    return Promise.reject(error);
});

export default instance;
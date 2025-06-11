import axios from 'axios'

const jwtInterceptor = axios.create({
    baseURL: '/api/auth/'
})

jwtInterceptor.interceptors.request.use(config => {

    config.headers.Authorization = `Bearer ${localStorage.getItem('access_token')}`

    return config;

})


export default jwtInterceptor;

 
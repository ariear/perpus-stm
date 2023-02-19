require('./bootstrap');
import { createApp } from 'vue'
import { createStore } from 'vuex'
import router from './router'
import App from './App.vue'
import axios from 'axios';

const store = createStore({
    state () {
        return {
            loggedIn : localStorage.getItem('loggedIn'),
            token: localStorage.getItem('token'),
            loginFailed: null,
            munculmenu: false
        }
      },
    mutations:{
        login(state , form){
            if (form.email && form.password) {
                axios.get('http://localhost:8000/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('http://localhost:8000/api/login', {
                        email: form.email,
                        password: form.password
                    }).then(res => {
                        if (res.data.success) {
                            localStorage.setItem("loggedIn", "true")
                            localStorage.setItem("token", res.data.token)

                            state.loggedIn = true
                            return location.href = '/dashboard'
                        }else{
                            state.loginFailed = true
                        }
                    }).catch(error => {
                        console.log(error);
                    })
                })
            }


        }
    }
})

const app = createApp({})
app.component('app-component', App)
app.use(store)
app.use(router)
app.mount('#app')

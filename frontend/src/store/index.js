import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: null || localStorage.getItem('accessToken')
  },
  getters:{
    loggedIn(state){
      return state.token != null
    }
  },
  mutations: {
    setToken( state, token){
        state.token= token
    },
    removeToken(state){
      state.token = null
    }
  },
  actions: {
    login(context, credential){
      return new Promise ((resolve, reject)=>{
        axios.post('http://127.0.0.1:8000/api/auth/login', credential)
          .then(response=>{
            localStorage.setItem('accessToken',response.data.user.access_token)          
            context.commit('setToken', response.data.user.access_token)
            resolve(response.data)
          }).catch(error=>{
            reject(error)
        })
      })
    }    ,
    LogOut(context){
      axios.defaults.headers.common['Authorization'] = 'Bearer ' + context.state.token

      return new Promise ((resolve, reject)=>{
        axios.post('http://127.0.0.1:8000/api/auth/logout')
          .then(response=>{   
            localStorage.removeItem('accessToken')                   
            context.commit('removeToken')
            resolve(response.data)
          }).catch(error=>{
            reject(error)
        })
      })
    },
    register(context, form){
      return new Promise ((resolve, reject)=>{
        axios.post('http://127.0.0.1:8000/api/auth/register', form)
          .then(response=>{   
            resolve(response.data)
          }).catch(error=>{
            reject(error)
        })
      })
    }
  },
  modules: {
  } 
})

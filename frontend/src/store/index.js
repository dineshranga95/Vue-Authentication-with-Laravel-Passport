import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    token: null || localStorage.getItem('accessToken')
  },
  mutations: {
    setToken( state, token){
        state.token= token
    }
  },
  getters:{
    
  },
  actions: {
    login(context, credential){
      axios.post('http://127.0.0.1:8000/api/auth/login', credential)
      .then(response=>{
        localStorage.setItem('accessToken',response.data.user.access_token)

        context.commit('setToken', response.data.user.access_token)
      }).catch(error=>{
        console.warn(error)
      })
      
    }    
  },
  modules: {
  } 
})

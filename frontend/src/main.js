import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

window.toastr = require('toastr')

require ("bootstrap")
import "./assets/scss/app.scss"

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')

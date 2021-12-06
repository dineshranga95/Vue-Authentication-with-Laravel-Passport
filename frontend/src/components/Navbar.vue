<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <router-link class="navbar-brand" to="/"><img src="../assets/logo.png" alt="logo" class="w-25"> </router-link>
                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                          <router-link class="nav-link active" to="/">Home</router-link>
                      </li>
                      <li class="nav-item">
                           <router-link class="nav-link" to="/about">About</router-link>
                      </li> 
                      <li class="nav-item">
                           <router-link class="nav-link" to="/login" v-if="!loggedIn">Login</router-link>
                      </li> 
                      <li class="nav-item">
                           <router-link class="nav-link" to="/register" v-if="!loggedIn">Register</router-link>
                      </li>
                      <li class="nav-item">
                           <router-link class="nav-link" to="/logOut" v-if="loggedIn">LogOut</router-link>
                      </li>         
                    </ul>      
                  </div>
                </div>
        </nav>
    </div>
</template>

<script>
export default {
    name:"Navbar",
    computed:{
      loggedIn(){
        return this.$store.getters.loggedIn
      }
    }
}
</script>
 
<style>

</style>
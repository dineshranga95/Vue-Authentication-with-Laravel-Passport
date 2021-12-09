<template>
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-md-5">
        <div class="card">
          <div class="card-header">User Login Form</div>
          <div class="card-body">
            <form @submit.prevent="login">
                <div class="form-group mb-3">
                  <label for="exampleInputEmail1">Email address</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" v-model="credential.email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group mb-3">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" v-model="credential.password" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="text-end">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>                
            </form>
          </div>
        </div>
      </div>
    </div>    
  </div>
</template>

<script>
export default {
  name:"Login",
    data(){
      return{
        credential:{
          email:null,
          password:null
        }
      }
    },
    methods:{
      login(){
        
        this.$store.dispatch('login', this.credential).then( response=>{ 
          //eslint-disable-next-line no-undef
          toastr.success(response.msg)     
          this.$router.push('/')
        }).catch(error=>{
          for (const [k, v] of Object.entries(error.response.data.data)){
             //eslint-disable-next-line no-undef
          toastr.error(v)
          console.warn(k)
          
          }
        })
      }
    }

}
</script>
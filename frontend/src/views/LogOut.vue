<template>
    <div></div>
</template>

<script>
export default {
    name: "LogOut",
    created(){
        return this.$store.dispatch('LogOut').then(response=>{
            //eslint-disable-next-line no-undef
            toastr.success(response.msg) 
            console.warn(response.msg);
            this.$router.push('/login')
        })
    }
}
</script>
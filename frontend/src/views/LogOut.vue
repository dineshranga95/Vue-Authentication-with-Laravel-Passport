<template>
    <div></div>
</template>

<script>
export default {
    name: "LogOut",
    created(){
        return this.$store.dispatch('LogOut').then(response=>{
            console.warn(response);
            this.$router.push('/login')
        })
    }
}
</script>
<template>

</template>

<script type="text/javascript">

export default{

    created(){
        localStorage.removeItem('token')
		localStorage.removeItem('user')
        Toast.fire({
                    icon: 'warning',
                    title: 'Log Out successfully'
                    })
        this.$router.push({name:'/'})
        
        
    }

}


</script>


<style>

</style>
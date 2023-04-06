<template>
	
	<div>
		<div class="row justify-content-center">
	      <div class="col-xl-9 col-lg-9 col-md-9">
	        <div class="card shadow-sm my-5">
	          <div class="card-body p-0">
	            <div class="row">
	              <div class="col-lg-12">
	                <div class="login-form">
	                  <div class="text-center">
	                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
	                  </div>
                  <form class="user" @submit.prevent="signup">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" v-model="form.name" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Full Name">
					  <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                    </div>
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" v-model="form.email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address">
						<small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" v-model="form.password" class="form-control" id="exampleInputPassword" placeholder="Password">
					  <small class="text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
					</div>
                    <div class="form-group">
                      <label>Confirm Password</label>
                      <input type="password" v-model="form.password_confirmation" class="form-control" id="exampleInputPasswordRepeat"
                        placeholder="Confirm Password">
						<small class="text-danger" v-if="errors.password_confirmation">{{ errors.password_confirmation[0] }}</small>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                  </form>
	                  <hr>
	                  <div class="text-center">
	                    <router-link to="/" class="font-weight-bold small" >Already have an account?</router-link>
	                  </div>
	                  <div class="text-center">
	                  </div>
	                </div>
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>

	</div>
</template>

<script type="text/javascript">



export default{

	created(){
		if(User.loggedIn()){
			this.$router.push({name:'home'})
			}
	},
	data(){

		return{

			form:{
				name:null,
				email:null,
				password:null,
				confirm_password:null
			},
			errors:{ }
		}
	},
	methods:{

		signup(){
			axios.post('/api/auth/signup',this.form)
			.then(res =>
					{ User.responseAfterLogin(res)
						Toast.fire({
								icon: 'success',
								title: 'Signed in successfully'
								})
					this.$router.push({name:'home'})				
					})
					
			.catch(error=>this.errors =error.response.data.errors)
			
			
		}
	}
}

	
</script>


<style type="text/css">
	

</style>
<template>
	
	<div>

        <div class="row">
            <router-link to="/all-employee" class="btn btn-primary">All Employee</router-link>
        </div>
		<div class="row justify-content-center">
	      <div class="col-xl-12 col-lg-12 col-md-12">
	        <div class="card shadow-sm my-5">
	          <div class="card-body p-0">
	            <div class="row">
	              <div class="col-lg-12">
	                <div class="login-form">
	                  <div class="text-center">
	                    <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                        <hr>
	                  </div>
                  <form class="user" @submit.prevent="employeeInsert" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                            <label>Name</label>
                            <input type="text" v-model="form.emp_name" class="form-control" id="exampleInputFirstName" placeholder="Enter Employee Full Name">
                            <small class="text-danger" v-if="errors.emp_name">{{ errors.emp_name[0] }}</small>
                            </div>
                            
                            <div class="col-md-6">
                            <label>Email</label>
                            <input type="text" v-model="form.emp_email" class="form-control" id="exampleInputFirstName" placeholder="Enter employee Email">
                            <small class="text-danger" v-if="errors.emp_email">{{ errors.emp_email[0] }}</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                            <label>Phone</label>
                            <input type="text" v-model="form.emp_phone" class="form-control" id="exampleInputFirstName" placeholder="Enter employee cell no:">
                            <small class="text-danger" v-if="errors.emp_phone">{{ errors.emp_phone[0] }}</small>
                            </div>
                            <div class="col-md-6">
                            <label>Salary</label>
                            <input type="text" v-model="form.emp_salary" class="form-control" id="exampleInputFirstName" placeholder="Enter employee salary">
                            <small class="text-danger" v-if="errors.emp_salary">{{ errors.emp_salary[0] }}</small>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-6">
                            <label>Address</label>
                            <textarea type="text" v-model="form.emp_address" class="form-control" id="exampleInputFirstName" placeholder="Enter employee address"></textarea>
                            <small class="text-danger" v-if="errors.emp_address">{{ errors.emp_address[0] }}</small>
                            </div>

                            <div class="col-md-6">
                            <label>National Id</label>
                            <input type="text" v-model="form.emp_nid" class="form-control" id="exampleInputFirstName" placeholder="Enter employee national id no"> 
                            <small class="text-danger" v-if="errors.emp_nid">{{ errors.emp_nid[0] }}</small>
                            </div>
                           
                        </div>
                        <div class="form-row">

                            <div class="col-md-6">
                            <label>Joining Date</label>
                            <input type="date" v-model="form.emp_join_date" class="form-control" id="exampleInputFirstName" placeholder="Enter employee Joining Date">
                            <small class="text-danger" v-if="errors.emp_join_date">{{ errors.emp_join_date[0] }}</small>
                            </div>

                            
                            
                        </div>
                        <div class="form-row">
                            
                            <div class="col-md-6">
                            <label>Photo</label>
                            <input type="file" @change="onFileSelect"  class="form-control" id="exampleInputFirstName" placeholder="Enter employee photo">
                            
                            </div>
                            <div class="col-md-6">
                                <img :src="form.emp_photo" alt="" style="height: 90px;width: 200px;">

                            </div>
                        </div>
                      
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Submit</button>
                    </div>
                    
                    <hr>
                  </form>
	                  
	                  
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
		if(!User.loggedIn()){
			this.$router.push({name:'/'})
			}
	},
	data(){

		return{

			form:{
				emp_name:null,
				emp_email:null,
        emp_phone:null,
        emp_salary:null,
        emp_address:null,
        emp_nid:null,
				emp_join_date:null,
				emp_photo:null
			},
			errors:{ }
		}
	},

  methods:{

    onFileSelect(event){

      let file = event.target.files[0];
      if(file.size>1048770){
        Notification.imageValidation();
      }else{
        let reader=new FileReader();
        reader.onload= event=>{
          this.form.emp_photo = event.target.result
          console.log(event.target.result);

        };
        reader.readAsDataURL(file)
      }
    
    },
    employeeInsert(){

        axios.post('/api/employee',this.form)
        .then(()=>{
          this.$router.push({name:'allEmployee'});
          Notification.success();

        })
        .catch(error=>  {this.errors=error.response.data.errors
          Notification.error();
        
        }
          
        )
    },
  }
	
}

	
</script>


<style type="text/css">
	

</style>
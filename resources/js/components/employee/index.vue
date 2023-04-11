<template>
	
	<div>

		
            <router-link to="/store-employee" class="btn btn-primary">Add Employee</router-link>
			<br><br>
        
		<input v-model="searchData" type="text" placeholder="Search Employee by name..." class="form-control" style="width: 300px;">
		<br>
		<div class="row">
            <div class="col-lg-12 mb-4">
              
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary"> Employee List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Phone</th>
						<th>Salary</th>
						<th>Join Date</th>
						<th>Nid</th>
						
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="employee in filterSearch" :key="employee.id">
                        <td>{{employee.emp_name}}</td>
						<td>{{employee.emp_email}}</td>
						<td><img id="img" :src="employee.emp_photo" alt=""></td>
						<td>{{employee.emp_phone}}</td>
						<td>{{employee.emp_salary}}</td>
						<td>{{employee.emp_join_date}}</td>
						<td>{{employee.emp_nid}}</td>
                        
                        <td>
							<a href="#" class="btn btn-sm btn-primary">Edit</a>
							<a href="#" class="btn btn-sm btn-danger">Delete</a>
						
						</td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
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
			allEmployee:[],
			searchData:''
		}
		
	},
	computed:{

		filterSearch(){

			return this.allEmployee.filter(employee=>{

				return employee.emp_name.match(this.searchData);
			})

		}
		
		
	},
	methods:{
		allemployee(){

			axios.get('/api/employee/')
			.then(({data})=>(this.allEmployee=data))
			.catch()
		}
	},
	created(){
		this.allemployee();
	}
}

	
</script>


<style type="text/css">
	
#img{
	height: 80px;
	width: 40px;
}
</style>
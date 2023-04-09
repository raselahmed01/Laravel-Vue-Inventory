
//----------Authentication Start------

let login=require('./components/auth/login.vue').default;
let register=require('./components/auth/register.vue').default;
let forgetpass=require('./components/auth/forgetpassword.vue').default;
let logout=require('./components/auth/logout.vue').default;

//----------End Authentication---------

let home=require('./components/home.vue').default;


//------Employee Components start-----

let storeEmployee =require('./components/employee/create.vue').default;
let allEmployee =require('./components/employee/index.vue').default;

export const routes=[

	{path:'/',component:login,name:'/'},
	{path:'/register',component:register,name:'register'},
	{path:'/forgetpass',component:forgetpass,name:'forgetpass'},
	{path:'/logout',component:logout,name:'logout'},
	{path:'/home',component:home,name:'home'},
	{path:'/store-employee',component:storeEmployee,name:'storeEmployee'},
	{path:'/all-employee',component:allEmployee,name:'allEmployee'}

];

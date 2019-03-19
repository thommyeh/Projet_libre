var profil = new Vue({
	el: "#profil-edit",
	  data:{
      user: "",
      name:"",
      email:"",
      message:""

    
  },

	methods:{
		EditProfil: function() {
			axios
			.post('/profil', {
				name: this.name,
				email: this.email,
				
			})
			this.name="";
			this.email="";
			this.message = "Le profil a bien été modifié";
			
			
			axios.get('/profildata').then(response => this.user = response.data);
		}

		},

	mounted(){

		axios.get('/profildata').then(response => this.user = response.data);
		

	}
	
})
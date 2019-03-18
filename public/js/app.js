var vm = new Vue({
	el: "#replace",
	data: {
		filters: [],
		urls:[],
		name: '',
		url: '',
		filtres: '',

		selected: '',
		message: '',



	},

	methods:{
		processForm: function() {
			axios
			.post('/CreateRss', {
				name: this.name,
				url: this.url,
				filtres: this.filtres,
			})
			this.message = "Le flux a bien été ajouté";
			this.name = "";
			this.url = "";
			this.filtres = "";
			axios.get('/rssdata').then(response => this.urls = response.data);
		},

		editFlux: function() {
			axios
			.post('/flux/delete', {
				id: this.selected,
			})
			axios.get('/rssdata').then(response => this.urls = response.data);



		}
	},

	mounted(){

		axios.get('/rssdata').then(response => this.urls = response.data);

	}
	
})



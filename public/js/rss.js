var rss = new Vue({
	el: "#replace",
	data: {
		filters: [],
		urls:[],
		name: '',
		url: '',
		filtres: '',

		selected: '',
		selected1: '',
		message: '',
		message1: '',



	},

	methods:{
		processForm: function() {
			axios
			.post('/CreateRss', {
				name: this.name,
				url: this.url,
				
			})
			this.message = "Le flux a bien été ajouté";
			this.name = "";
			this.url = "";
			
			axios.get('/rssdata').then(response => this.urls = response.data);
		},

		FiltersForm: function() {
			axios
			.post('/CreateFilter', {
				filtres: this.filtres,
				
			})
			this.message1 = "Le filtre a bien été ajouté";
			this.filtres = "";
			axios.get('/filterdata').then(response => this.filters = response.data);
		},

		editFlux: function() {
			axios
			.post('/flux/delete', {
				id: this.selected,
			})
			axios.get('/rssdata').then(response => this.urls = response.data);



		},

				editFilters: function() {
			axios
			.post('/filter/delete', {
				id: this.selected1,
			})
			axios.get('/filterdata').then(response => this.filters = response.data);



		}
	},

	mounted(){

		axios.get('/rssdata').then(response => this.urls = response.data);
		axios.get('/filterdata').then(response => this.filters = response.data);

	}
	
});



var vm = new Vue({
	el: "#display",

	data: {
		filters: [],
		urls: [],
		newfilter:''
	},

		  methods:{
        addfilter(){
            this.filters.push(this.newfilter);
            this.newfilter = '';
        }
      },

	mounted(){

		axios.get('/rssdata').then(response => this.filters = response.data);
		axios.get('/urldata').then(response => this.urls = response.data);

	}



	
})

var vm = new Vue({
	el: "#filter",

	data: {
		filters: [],
		urls:[],
		
		newfilter:''
	},

		  methods:{
        addfilter(){
            this.filters.push(this.newfilter);
            this.newfilter = '';
        }
      },

	mounted(){
		axios.get('/urldata').then(response => this.urls = response.data);
		axios.get('/rssdata').then(response => this.filters = response.data);
	
	
	}
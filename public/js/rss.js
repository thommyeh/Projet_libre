Vue.component('validation-errors', {
  data() {
    return {

    }
  },
  props: ['errors'],
  template: `<div v-if="validationErrors">
                        <ul class="alert alert-danger">
                            <li v-for="(value, key, index) in validationErrors">{{ value }}</li>
                        </ul>
                    </div>`,
  computed: {
    validationErrors() {
      let errors = Object.values(this.errors);
      errors = errors.flat();
      return errors;
    }
  }
});

var rss = new Vue({
  el: "#replace",
  data: {
    filters: [],
    urls: [],
    name: '',
    url: '',
    filtres: '',

    selected: '',
    selected1: '',
    validationErrors: '',
    message: '',
    




  },

  methods: {
    processForm: function() {
      axios
        .post('/CreateRss', {
          name: this.name,
          url: this.url,

        }).then(response => {
          this.message = '<p class="alert alert-success">Le flux a bien été ajouté</p>';
        }).catch(error => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }

        })

      //this.message = "Le flux a bien été ajouté";
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



    },

  },

  mounted() {

    axios.get('/rssdata').then(response => this.urls = response.data);
    axios.get('/filterdata').then(response => this.filters = response.data);

  }

});
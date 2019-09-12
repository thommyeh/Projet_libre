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
    selected2: '',
    selected3: '',
    validationErrors: '',
    message: '',
    




  },

  methods: {
    newUrl: function() {
      axios
        .post('/newurl', {
          name: this.name,
          url: this.url,
          type: this.selected2,

        }).then(response => {
          this.message = '<p class="alert alert-success">Le flux a bien été ajouté</p>';
        }).catch(error => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }

        })

      this.name = "";
      this.url = "";
      this.selected2 = "";

      axios.get('/urldata').then(response => this.urls = response.data);
    },

    FiltersForm: function() {
      axios
        .post('/createfilter', {
          filtres: this.filtres,
          type: this.selected3,

        })
      this.message1 = "Le filtre a bien été ajouté";
      this.filtres = "";
      this.selected3 = "";
      axios.get('/filterdata').then(response => this.filters = response.data);
    },

    editFlux: function() {
      axios
        .post('/flux/delete', {
          id: this.selected,
        })
      axios.get('/urldata').then(response => this.urls = response.data);



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

    axios.get('/urldata').then(response => this.urls = response.data);
    axios.get('/filterdata').then(response => this.filters = response.data);

  }

});
var character = new Vue({
  el: "#character",
  data: {
    name: '',
    
    },

  methods: {
    Form: function() {
      axios
        .post('/editeur', {
          name: this.name,
          

        }).then(response => {
          this.message = '';
        }).catch(error => {
          if (error.response.status == 422) {
            this.validationErrors = error.response.data.errors;
          }

        })
        
      
      
      

      
    },

    
  },


});
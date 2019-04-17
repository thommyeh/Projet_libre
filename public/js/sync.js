var synchro = new Vue({
  el: "#sync",
  data: {
    mess: "",
    




  },

  methods: {
            SynchroFlux: function() {
      
      axios.get('/synchro');



    },
  },
  });
$(document).ready(function(){
  
  /* Au clic sur un élément de menu... */
  $('#FiltresTab').click(function(event){
    
    /* On récupère l'url du lien sur lequel on vient de cliquer. */
    var url = $(this).attr("href");
    
    /*
     * Dans notre bloc #content, on inject le contenu
     * de la page ciblée (par le href) en se limitant
     * à ce qui est dans le bloc #content.
     */
    $('#contenu1').load(url + " #contenu");
    
    /*
     * On évite le comportement par défaut qui est de 
     * nous envoyer sur la page donnée dans le href).
     */
    event.preventDefault();
  });
  
});

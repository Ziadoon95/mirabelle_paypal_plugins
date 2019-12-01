jQuery( document ).ready(function($) {
$(".validate").click(function(event){
    event.preventDefault();
    var id=$(this).attr("data-id");
    


  if (confirm("Avez-vous envoyé l'attestation ?")) {
  
    jQuery.post(
        ajaxurl,
        {
            'action': 'donneurs_valide',
            'id' : id
        },
        function(response){
                console.log(response);
                $(".bullet[data-id="+id+"]").removeClass("gray").addClass("green");
            }
            
    );
    document.getElementById('btn').style.visibility= 'hidden';

  } else {

  }

});

});
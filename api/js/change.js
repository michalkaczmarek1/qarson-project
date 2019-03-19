
//skrypt usuwajacy auto
$(document).ready(function(){
 

    $(document).on('click', '.change-car', function(e){

        e.preventDefault();
        
    	var route = 'http://localhost/qarson';
    	
    	var id_car = $(this).attr('data-id');
    	
        // wysłanie zapytanie do serwera o usuniecie
        $.ajax({
            url: $(this).attr('href'),
            type : "POST",
            dataType : 'json',
            data : JSON.stringify({ id: id_car }),
            success : function(result) {
        
                // przeładowanie listy samochodow
                // showCars("", result.message);
                
                json_url = route+"/api/api.php/cars";
               
                if(result.success_change){
                    // $("<div class='alert alert-success'>"+result.success_change+"</div>").appendTo('.infos');
                    $("<div class='infos alert alert-success'>"+result.success_change+"</div>").replaceAll('.infos');
                    
                } else {
                    $("<div class='infos alert alert-danger'>"+result.error_change+"</div>").replaceAll('.infos');
                }

                $.getJSON(json_url, function(data){
                
                    showCars(data, route, true);
                
                });

                
                
                
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

    });
});
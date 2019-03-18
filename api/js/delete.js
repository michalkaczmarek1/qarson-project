
//skrypt usuwajacy auto
$(document).ready(function(){
 

    $(document).on('click', '.delete-car', function(e){

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

                $.getJSON(json_url, function(data){
                
                    showCars(data, route);
                
                });

                
                
                
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

    });
});

//script delete car
$(document).ready(function(){
 

    $(document).on('click', '.delete-car', function(e){

        e.preventDefault();
        
    	var route = 'http://localhost/qarson';
    	
    	var id_car = $(this).attr('data-id');
    	
        // send query AJAX to server
        $.ajax({
            url: $(this).attr('href'),
            type : "POST",
            dataType : 'json',
            data : JSON.stringify({ id: id_car }),
            success : function(result) {
        
                
                json_url = route+"/api/api.php/cars";

                //display statement
                if(result.success_delete){
                    $("<div class='infos alert alert-danger'>"+result.success_delete+"</div>").replaceAll('.infos');
                } else {
                    $("<div class='infos alert alert-danger'>"+result.error_delete+"</div>").replaceAll('.infos');
                }

                //reload list of cars
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
//script responsible for read cars

$(document).ready(function () {
    
    var read = $('#read'),
        route = 'http://localhost/qarson';
        
    // handling click read button
    read.on('click', function (e) {
        
        
        e.preventDefault();
        
        //send AJAX on server to read data
        $.get(route+"/api/api.php/cars",
            function (data) {
                
                if(data.empty){
                    $("<div class='infos alert alert-danger'>Brak rekordów bazie</div>").appendTo('.infos');
                } else {
                    showCars(data, route);
                }
                
            
            },
        );

       
        $(this).attr('disabled', true);
        
    });
       
  
});
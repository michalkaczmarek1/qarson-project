function showCars(data, route, replace = false){

    //create table for get news
    
    table = '<table class="table table-responsive" id="table"><thead><tr><th scope="col">Id</th><th scope="col">Marka</th><th scope="col">Model</th><th scope="col">Silnik</th><th scope="col">Nazwa modelu</th><th scope="col">Zdjęcie</th><th scope="col">Dostępność</th><th>Akcje</th></thead>';
    table += "<tbody>";
    
    //insert data to table
    $.each(data, function (index, value) { 
        if(value.availability === "Nie"){
            table += '<tr style="background-color:#959ba5;"><td>'+value.id+'</td>';    
        } else {
            table += '<tr><td>'+value.id+'</td>';
        }
        table += '<td>'+value.mark+'</td>';
        table += '<td>'+value.model+'</td>';
        table += '<td>'+value.engine+'</td>';
        table += '<td>'+value.model_name+'</td>';
        if(value.photo !== "brak informacji"){
            table += '<td><a href="'+value.photo+'" target="_blank">Kliknij aby zobaczyć zdjęcie</a></td>';
        } else {
            table += '<td>'+value.photo+'</td>';
        }
        table += '<td>'+value.availability+'</td>';
        if(value.availability === "Nie"){
            table += '<td><a href="'+route+'/api/api.php/change?change=Tak" data-id='+value.id+' class="change-car btn btn-warning">Zmien dostępność</a>';    
        } else {
            table += '<td><a href="'+route+'/api/api.php/change?change=Nie" data-id='+value.id+' class="change-car btn btn-warning">Zmien dostępność</a>';                
        }
        table += '<td><a href="'+route+'/api/api.php/delete" data-id='+value.id+' class="delete-car btn btn-danger">Usuń</a>';                
        
    });

    table += "</tbody>";
    table += "</table>";
    
    if(replace === false){
        $(table).appendTo('#content');
    } else {
        $(table).replaceAll('#table');
    }
    
}

//script responsible for read news

$(document).ready(function () {
    
    var refresh = $('#refresh'),
        route = 'http://localhost/qarson';
        
    // handling click read button
    refresh.on('click', function (e) {
        
        
        e.preventDefault();
        
        //send AJAX on server to read data
        $.get(route+"/api/api.php/cars",
            function (data) {
                
                $("<div class='infos'></div>").replaceAll('.infos');
                showCars(data, route, true);
            
            },
        );

       
        // $(this).attr('disabled', true);
    });
       
  
});
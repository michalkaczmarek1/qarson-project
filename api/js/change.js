
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

                $.getJSON(json_url, function(data){
                
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
                        // the form handle delete news
                        table += '<form style="display: inline-block;" method="post" id="delete-form" action="'+route+'/api-news.php/delete"><input type="hidden" value="'+value.news_id+'" name="news_id"><input type="submit" value="Usuń" class="btn btn-danger"></form>';
                    });

                    table += "</tbody>";
                    table += "</table>";

                    $(table).replaceAll('#table');
                
                });

                
                
                
            },
            error: function(xhr, resp, text) {
                console.log(xhr, resp, text);
            }
        });

    });
});
//script responsible for read news

$(document).ready(function () {
    
    var read = $('#read'),
        route = 'http://localhost/qarson';
        
    // handling click read button
    read.on('click', function (e) {
        
        
        e.preventDefault();
        
        //send AJAX on server to read data
        $.get(route+"/api/api.php/cars",
            function (data) {
                
                //create table for get news
                table = '<table class="table table-responsive" id="table"><thead><tr><th scope="col">Id</th><th scope="col">Marka</th><th scope="col">Model</th><th scope="col">Silnik</th><th scope="col">Nazwa modelu</th><th scope="col">Zdjęcie</th><th scope="col">Dostępność</th><th>Akcje</th></thead>';
                table += "<tbody>";
                
                //insert data to table
                $.each(data, function (index, value) { 
                    table += '<tr><td>'+value.id+'</td>';
                    table += '<td>'+value.mark+'</td>';
                    table += '<td>'+value.model+'</td>';
                    table += '<td>'+value.engine+'</td>';
                    table += '<td>'+value.model_name+'</td>';
                    table += '<td>'+value.photo+'</td>';
                    table += '<td>'+value.availability+'</td>';
                    table += '<td><a href="'+route+"/views/news/layouts/edit-form.html.php/edit/?id="+value.news_id+'" class="btn btn-warning">Zmien dostępność</a>';
                    // the form handle delete news
                    table += '<form style="display: inline-block;" method="post" id="delete-form" action="'+route+'/api-news.php/delete"><input type="hidden" value="'+value.news_id+'" name="news_id"><input type="submit" value="Usuń" class="btn btn-danger"></form>';
                });

                table += "</tbody>";
                table += "</table>";

                $(table).appendTo('#content');

                
            },
        );

        // $(this).attr('disabled', true);
    });
       
});
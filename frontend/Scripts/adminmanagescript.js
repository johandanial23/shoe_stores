$.getJSON(
    'http://localhost:8888/products', 
    function(data){
        console.log(data);

        var product = data;

        $.each(product, function(index, value){
            $('.products').append('<tr><td>'+value.id+'</td><td>'+value.name+'</td><td>'+value.price+'</td><td><a href="AdminEdit.html?'+ value.id +'"><i class="fa fa-gear"></i></a> &nbsp;&nbsp;&nbsp; <a onclick="deleteOrder('+value.id+')"><i class="fa fa-trash"></i></a></td></tr>');
        }); 
    }
);


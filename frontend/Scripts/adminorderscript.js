$.getJSON(
    'http://localhost:8888/orders', 
    function(data){
        console.log(data);

        var product = data;

        $.each(product, function(index, value){
            $('.products').append('<tr><td>'+value.id+'</td><td>'+value.productName+'</td><td class="w3-center">'+value.quantity+'</td><td>'+value.name+'</td><td>'+value.address+'</td><td>'+value.phone+'</td><td class="w3-center"><a onclick="deleteOrder('+value.id+')"><i class="fa fa-arrow-right"></i></a></td></tr>');
        }); 
    }
);
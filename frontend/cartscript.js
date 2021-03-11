$.getJSON(
    'http://localhost:8888/carts',
    function(data){
        console.log(data);

        var product = data;
        var total = 0;

        $.each(product, function(index, value){
            $('.cartsItem').append('<p><a href="#" onclick="deleteCart('+value.id+')">'+ value.name +'</a><span class="price">RM'+ value.price+'</span></p>');
            
            
            total = total + parseFloat(value.price);
        });
        $('#total').html("RM " +total);
        $('#ItemCount').html('<i class="fa fa-shopping-cart"></i> <b>'+ product.length +'</b>');
    }
);


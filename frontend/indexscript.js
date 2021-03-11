$.getJSON(
    'http://localhost:8888/product/sale', 
    function(data){
        console.log(data);

        var product = data;

        $.each(product, function(index, value){
            $('.products').append('<div class="w3-col l3 s6"><div class="w3-container"><div class="w3-display-container"><img src="img/'+ value.image +'" style="width:200px;height:150px;"><span class="w3-tag w3-display-topleft">New</span><div class="w3-display-middle w3-display-hover"><button class="w3-button w3-black" onclick="addCart('+ index +')">Buy now <i class="fa fa-shopping-cart"></i></button></div></div><p>'+ value.name +'<br><b>RM ' + value.price + '</b></p></div></div>');
        }); 

        $('#productCount').html(product.length + " items");
    }
);
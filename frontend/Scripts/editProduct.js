var url = document.URL;
var id = url.substring(url.lastIndexOf('?') + 1);

$.getJSON(
    'http://localhost:8888/product/' + id, 
    function(data){
        console.log(data);

        var product = data;

        var name = document.getElementById('name');
        var price = document.getElementById('price');

        $.each(data, function(index, value){
            name.value = value.name;
            price.value = value.price;
        }); 
    }
);


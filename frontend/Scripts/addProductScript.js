
        $(document).ready(function(){

            $('#myform').on('submit', function(event){
                event.preventDefault();

                if($('#image').val() == ""){
                    alert('Image is required');
                }else if($('#title').val() == ""){
                    alert('Title is required');
                }else if($('#price').val() == ""){
                    alert('Price is required');
                }else if($('#info').val() == ""){
                    alert('Description is required');
                }else{
                    var formData = $(this).serialize();
                    var image = $('#image').val();
                    var title = $('#title').val();
                    var price = $('#price').val();
                    var info = $('#info').val();
                    $.ajax({
                        url: 'http://aneka.amdev.tech/api/product',
                        method: "POST",
                        data: {
                            title:title,
                            image:image,
                            price:price,
                            info:info

                        },
                        success:function(data){
                            alert("Product Added");
                        }
                    });
                }
            });
        });
$('.addToCartBtn').click(function (e){
    e.preventDefault();

    var product_id=$(this).closest('.product_data').find('.prod_id').val();
    var product_qty=$(this).closest('.product_data').find('.qty_input').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        method: "POST",
        url: "/add-to-cart",
        data: {
            'product_id':product_id,
            'product_qty':product_qty,
        },
        success: function (response) {
            Swal.fire({
            position: 'top',
            text:(response.status),
            showConfirmButton: true,
            })
            
            
        }
    });
});

$(document).ready(function (){
$('.increasement-btn').click(function (e){
    e.preventDefault();
    var inc_limit = $(this).closest('.product_data').find('.prod_qty').val();
    var inc_value = $(this).closest('.product_data').find('.qty_input').val();
    var value = parseInt(inc_value, inc_limit);
    value = isNaN(value) ? 0 : value;
    if(value < 10)
    {
        value++;
        $(this).closest('.product_data').find('.qty_input').val(value);
    }
});

$('.decrement-btn').click(function (e){
    e.preventDefault();
   
    var dec_value = $(this).closest('.product_data').find('.qty_input').val();
    var value = parseInt(dec_value, 10);
    value = isNaN(value) ? 0 : value;
    if(value > 1)
    {
        value--;
        $(this).closest('.product_data').find('.qty_input').val(value);
    }
});

$('.delete-cart-item').click(function (e) { 
    e.preventDefault();
    
    var prod_id = $(this).closest('.product_data').find('.prod_id').val();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "delete-cart-item",
        data: {
            'prod_id':prod_id,
        },
        success: function (response) {
            window.location.reload();
            // Swal.fire({
            //     position: 'top-end',
            //     icon:"success",
            //     text:(response.status),
            //     showConfirmButton: true,
            //     })
            alert(response.status);
            
        }
    });
});

$('.changeQuantity').click(function (e) { 
    e.preventDefault();
    
    var prod_id = $(this).closest('.product_data').find('.prod_id').val();
    var prod_qty = $(this).closest('.product_data').find('.qty_input').val();
    data = {
        'prod_id' : prod_id,
        'prod_qty' : prod_qty,
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        type: "POST",
        url: "update-cart",
        data: data,
        
        success: function (response) {
            window.location.reload();
        }
    });
});

});
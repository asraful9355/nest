     <script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/slick.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/waypoints.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/wow.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/select2.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/counterup.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/images-loaded.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/isotope.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/scrollup.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3')}}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3')}}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
           case 'info':
           toastr.info(" {{ Session::get('message') }} ");
           break;
           case 'success':
           toastr.success(" {{ Session::get('message') }} ");
           break;
           case 'warning':
           toastr.warning(" {{ Session::get('message') }} ");
           break;
           case 'error':
           toastr.error(" {{ Session::get('message') }} ");
           break;
        }
        @endif
  </script>

  {{-- Image Show Script --}}
  <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
</script>

<script type="text/javascript">
    
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        }
    })
    /// Start product view with Modal 

     function productView(id){
        // alert(id)
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/'+id,
            dataType: 'json',
            success:function(data){
                  // console.log(data)
            $('#pname').text(data.product.product_name_en);
            $('#pprice').text(data.product.selling_price);
            $('#pcode').text(data.product.product_code);
            $('#pcategory').text(data.product.category.category_name_en);
            $('#pbrand').text(data.product.brand.brand_name_en);
            $('#pimage').attr('src','/'+data.product.product_thambnail );

            $('#product_id').val(id);
            $('#qty').val(1);
            
            // Product Price 
            if (data.product.discount_price == null) {
                $('#pprice').text('');
                $('#oldprice').text('');
                $('#pprice').text(data.product.selling_price);
            }else{
                $('#pprice').text(data.product.discount_price);
                $('#oldprice').text(data.product.selling_price); 
            } // end else

             /// Start Stock Option
             if (data.product.product_qty > 0) {
                $('#aviable').text('');
                $('#stockout').text('');
                $('#aviable').text('aviable');
            }else{
                $('#aviable').text('');
                $('#stockout').text('');
                $('#stockout').text('stockout');
            } 
            ///End Start Stock Option
             ///Size 
             $('select[name="size"]').empty();
             $.each(data.size,function(key,value){
                $('select[name="size"]').append('<option value="'+value+' ">'+value+'  </option')
                if (data.size == "") {
                    $('#sizeArea').hide();
                }else{
                     $('#sizeArea').show();
                }
             }) // end size
                     ///Color 
               $('select[name="color"]').empty();
             $.each(data.color,function(key,value){
                $('select[name="color"]').append('<option value="'+value+' ">'+value+'  </option')
                if (data.color == "") {
                    $('#colorArea').hide();
                }else{
                     $('#colorArea').show();
                }
             }) // end size


          }
        })
    }// End Product View With Modal 

    // start add to cart product 

    function addToCart(){
     var product_name_en = $('#pname').text();  
     var id = $('#product_id').val();
     var color = $('#color option:selected').text();
     var size = $('#size option:selected').text();
     var quantity = $('#qty').val(); 
     $.ajax({
        type: "POST",
        dataType : 'json',
        data:{
            color:color, size:size, quantity:quantity,product_name_en:product_name_en
        },
        url: "/cart/data/store/"+id,
        success:function(data){
            miniCart();
            $('#closeModal').click();
           // console.log(data)
            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }
        // End Message  
    } 
     }) 
    } // End Add To Cart Product 

    /// Start Details Page Add To Cart Product 
       function addToCartDetails(){
     var product_name_en = $('#dpname').text();  
     var id = $('#dproduct_id').val();
     var color = $('#dcolor option:selected').text();
     var size = $('#dsize option:selected').text();
     var quantity = $('#dqty').val(); 
     $.ajax({
        type: "POST",
        dataType : 'json',
        data:{
            color:color, size:size, quantity:quantity,product_name_en:product_name_en
        },
        url: "/dcart/data/store/"+id,
        success:function(data){
            miniCart();
          
            // console.log(data)
            // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }
              // End Message  
        } 
     }) 
    } 
     /// Eend Details Page Add To Cart Product 

 </script>
<script type="text/javascript">
    
    function miniCart(){
       $.ajax({
           type: 'GET',
           url: '/product/mini/cart',
           dataType: 'json',
           success:function(response){
                 // console.log(response)
        $('span[id="cartSubTotal"]').text(response.cartTotal);
        $('#cartQty').text(response.cartQty);
        var miniCart = ""
        $.each(response.carts, function(key,value){
           miniCart += ` <ul>
            <li>
                <div class="shopping-cart-img">
                    <a href="shop-product-right.html"><img alt="Nest" src="/${value.options.image} " style="width:50px;height:50px;" /></a>
                </div>
                <div class="shopping-cart-title" style="margin: -73px 74px 14px; width" 146px;>
                    <h4><a href="shop-product-right.html"> ${value.name} </a></h4>
                    <h4><span>${value.qty} × </span>${value.price}</h4>
                </div>
                <div class="shopping-cart-delete" style="margin: -85px 1px 0px;">
                    <a type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"  ><i class="fi-rs-cross-small"></i></a>
                </div>
            </li> 
        </ul>
        <hr><br>  
               `  
          });
            $('#miniCart').html(miniCart);
           }
       })
    }

    miniCart();

     // Mini Cart Remove Start 
   function miniCartRemove(rowId){
     $.ajax({
        type: 'GET',
        url: '/minicart/product/remove/'+rowId,
        dataType:'json',
        success:function(data){
        miniCart();
             // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  icon: 'success', 
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    title: data.error, 
                    })
                }
              // End Message  
        }
     })
   }
      // Mini Cart Remove End 
</script>
   
   <!--  /// Start Wishlist Add -->
<script type="text/javascript">
        
    function addToWishList(product_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishlist/"+product_id,
            success:function(data){
                wishlist();
                // Start Message 
        const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000 
        })
        if ($.isEmptyObject(data.error)) {
                
                Toast.fire({
                type: 'success',
                icon: 'success', 
                title: data.success, 
                })
        }else{
           
       Toast.fire({
                type: 'error',
                icon: 'error', 
                title: data.error, 
                })
            }
          // End Message  
            }
        })
    }
</script>



<!--  /// Start Load Wishlist Data -->
<script type="text/javascript">
        
    function wishlist(){
        $.ajax({
            type: "GET",
            dataType: 'json',
            url: "/get-wishlist-product/",
            success:function(response){
                $('#wishQty').text(response.wishQty);
                var rows = ""
                   $.each(response.wishlist, function(key,value){
        rows += `<tr class="pt-30">
                        <td class="custome-checkbox pl-30">
                            
                        </td>
                        <td class="image product-thumbnail pt-40"><img src="/${value.product.product_thambnail}" alt="#" /></td>
                        <td class="product-des product-name">
                            <h6><a class="product-name mb-10" href="shop-product-right.html">${value.product.product_name_en} </a></h6>
                            <div class="product-rate-cover">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small ml-5 text-muted"> (4.0)</span>
                            </div>
                        </td>
                        <td class="price" data-title="Price">
                        ${value.product.discount_price == null
                        ? `<h3 class="text-brand">$${value.product.selling_price}</h3>`
                        :`<h3 class="text-brand">$${value.product.discount_price}</h3>`
                        }
                            
                        </td>
                        <td class="text-center detail-info" data-title="Stock">
                            ${value.product.product_qty > 0 
                                ? `<span class="stock-status in-stock mb-0"> In Stock </span>`
                                :`<span class="stock-status out-stock mb-0">Stock Out </span>`
                            } 
                           
                        </td>
                       
                        <td class="action text-center" data-title="Remove">
                            <a type="submit" class="text-body" id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fi-rs-trash"></i></a>
                        </td>
                    </tr> ` 
       });
       $('#wishlist').html(rows); 
                }
            })
        }
    wishlist();


    // Wishlist Remove Start 
     function wishlistRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/"+id,
                success:function(data){
                wishlist();
                     // Start Message 
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',
                  
                  showConfirmButton: false,
                  timer: 3000 
            })
            if ($.isEmptyObject(data.error)) {
                    
                    Toast.fire({
                    type: 'success',
                    icon: 'success', 
                    title: data.success, 
                    })
            }else{
               
           Toast.fire({
                    type: 'error',
                    icon: 'error', 
                    title: data.error, 
                    })
                }
              // End Message  
                }
            })
        }
 // Wishlist Remove End

   
</script>

<!--  /// End Load Wishlist Data -->

<!--  /// Start Compare Add -->
<script type="text/javascript">
        
    function addToCompare(product_id){
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-compare/"+product_id,
            success:function(data){
             
                 // Start Message 
        const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              
              showConfirmButton: false,
              timer: 3000 
        })
        if ($.isEmptyObject(data.error)) {
                
                Toast.fire({
                type: 'success',
                icon: 'success', 
                title: data.success, 
                })
        }else{
           
       Toast.fire({
                type: 'error',
                icon: 'error', 
                title: data.error, 
                })
            }
          // End Message  
            }
        })
    }
</script> 
<!--  /// End Compare Add -->





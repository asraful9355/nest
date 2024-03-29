@extends('backend.admin.layouts.master')
<!-- Main Content -->
@section('page_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Edit Blog Post </div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Edit Blog Post </li>
            </ol>
         </nav>
      </div>
      <div class="ms-auto">
      </div>
   </div>
   <!--end breadcrumb-->
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-10">
               <div class="card">
                  <div class="card-body">
                     <form id="myForm" method="post" action="{{ route('update.blog.post',$blogpost->id) }}" enctype="multipart/form-data" >
                        @csrf
                
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Category</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="category_id" class="form-select" id="inputVendor">
                                 <option></option>
                                 @foreach($blogcategory as $cat)
                                 <option value="{{ $cat->id }}" {{ $cat->id == $blogpost->category_id ? 'selected' : '' }} >{{ $cat->blog_category_name_en }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Post En</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="post_title_en" class="form-control"  value="{{ $blogpost->post_title_en }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Post Bn</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="post_title_bn" class="form-control"  value="{{ $blogpost->post_title_bn }}" />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Short Decs En</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="post_short_description_en" class="form-control" id="inputProductDescription" rows="3">
                              {{ $blogpost->post_short_description_en }}
                              </textarea>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Short Decs Bn</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea name="post_short_description_bn" class="form-control" id="inputProductDescription" rows="3">
                              {{ $blogpost->post_short_description_bn }}
                              </textarea>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Long Decs En</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea class="mytextarea" name="post_long_description_en">
                              {!! $blogpost->post_short_description_en !!}
                              </textarea>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Long Decs Bn</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <textarea class="mytextarea" name="post_long_description_bn">
                              {!! $blogpost->post_short_description_bn !!}
                              </textarea>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Blog Post Image </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="file" name="post_image" class="form-control"  id="image"   />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0"> </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <img id="showImage" src="{{ asset($blogpost->post_image) }}" alt="Admin" style="width:100px; height: 100px;"  >
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-sm-3"></div>
                           <div class="col-sm-9 text-secondary">
                              <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
                           </div>
                        </div>
                  </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function (){
       $('#myForm').validate({
           rules: {
               category_name: {
                   required : true,
               }, 
           },
           messages :{
               category_name: {
                   required : 'Please Enter Category Name',
               },
           },
           errorElement : 'span', 
           errorPlacement: function (error,element) {
               error.addClass('invalid-feedback');
               element.closest('.form-group').append(error);
           },
           highlight : function(element, errorClass, validClass){
               $(element).addClass('is-invalid');
           },
           unhighlight : function(element, errorClass, validClass){
               $(element).removeClass('is-invalid');
           },
       });
   });
   
</script>
<script type="text/javascript">
   $(document).ready(function(){
   	$('#image').change(function(e){
   		var reader = new FileReader();
   		reader.onload = function(e){
   			$('#showImage').attr('src',e.target.result);
   		}
   		reader.readAsDataURL(e.target.files['0']);
   	});
   });
</script>
@endsection
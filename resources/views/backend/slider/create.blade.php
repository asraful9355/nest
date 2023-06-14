@extends('backend.admin.layouts.master')
<!-- Main Content -->
@section('page_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
   <!--breadcrumb-->
   <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
      <div class="breadcrumb-title pe-3">Add Slider </div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Add Slider </li>
            </ol>
         </nav>
      </div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('slider.index') }}" class="btn btn-primary">All Slider</a> 				 
         </div>
      </div>
   </div>
   <!--end breadcrumb-->
   <div class="container">
      <div class="main-body">
         <div class="row">
            <div class="col-lg-10">
               <div class="card">
                  <div class="card-body">
                     <form id="myForm"  method="post" action="{{ route('slider.store') }}" enctype="multipart/form-data" >
                        @csrf
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Slider Title En</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="slider_title_en" class="form-control"   />
                           </div>
                         @error('slider_title_en')
                           <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Slider Title Bn</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="slider_title_bn" class="form-control"   />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Short Title En</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="short_title_en" class="form-control"   />
                           </div>
                         @error('short_title_en')
                           <span class="text-danger">{{ $message }}</span>
                         @enderror
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Short Title Bn</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="short_title_Bn" class="form-control"   />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Slider Image  </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <input type="file" name="slider_image" class="form-control"  id="image"   />
                           </div>
                           @error('slider_image')
                           <span class="text-danger">{{ $message }}</span>
                           @enderror
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0"> </h6>
                           </div>
                           <div class="col-sm-9 text-secondary">
                              <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Admin" style="width:100px; height: 100px;"  >
                           </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Status</h6>
                             </div>
                             <div class="col-sm-9 text-secondary">
                              <select name="status" id="status" class="form-control">
                                 <option value="1">Active</option>
                                 <option value="0">Disable</option>
                               </select>
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
               slider_title_en: {
                   required : true,
               }, 
               short_title_en: {
                   required : true,
               },
               slider_image: {
                   required : true,
               },
           },
           messages :{
               slider_title_en: {
                   required : 'Please Enter slider Title En',
               },
               slider_image: {
                   required : 'Please Enter Slider Image',
               },
               short_title_en: {
                   required : 'Please Enter slider Url',
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


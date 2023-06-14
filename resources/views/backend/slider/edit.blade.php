@extends('backend.admin.layouts.master')
<!-- Page Title -->
@section('page_title', 'Admin Dashboard')
<!-- Additional CSS -->
@push('Backend_style')
<link href="{{ asset('backend') }}/assets/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
@endpush
<!-- Main Content -->
@section('page_content')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Edit slider</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit slider</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
             <a href="{{ route('slider.create') }}" class="btn btn-primary">Add slider</a>
               
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
   
    <hr/>
    <div class="card">
        <div class="card-body">
          <form id="myForm" method="post" action="{{ route('slider.update',$slider->id) }}" enctype="multipart/form-data">
            @csrf
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <h6 class="mb-0">slider Name En</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="text" name="slider_title_en" class="form-control"  value="{{ $slider->slider_title_en}}" />
                  </div>
               </div>
               @error('slider_title_en')
               <span class="text-danger">{{ $message }}</span>
               @enderror
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <h6 class="mb-0">slider Name Bn</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                     <input type="text" name="slider_title_bn" class="form-control" value="{{ $slider->slider_title_bn}}" />
                  </div>
               </div>
               @error('slider-title_bn')
               <span class="text-danger">{{ $message }}</span>
               @enderror
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <h6 class="mb-0">Short Title En</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="text" name="short_title_en" class="form-control"  value="{{ $slider->short_title_en}}" />
                  </div>
               </div>
               @error('short_title_en')
               <span class="text-danger">{{ $message }}</span>
               @enderror
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <h6 class="mb-0">Short Title Bn</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                     <input type="text" name="short_title_bn" class="form-control" value="{{ $slider->short_title_bn}}" />
                  </div>
               </div>
               @error('slider-title_bn')
               <span class="text-danger">{{ $message }}</span>
               @enderror
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <h6 class="mb-0">slider Image </h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                     <input type="file" name="slider_image" class="form-control"  id="image"/>
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
                     <img id="showImage" src="{{ asset($slider->slider_image) }}" alt="Admin" style="width:100px; height: 100px;">
                  </div>
               </div>

               <div class="row mb-3">
                <div class="col-sm-3">
                   <h6 class="mb-0">Status</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <select name="status" id="status" class="form-control">
                    @if ($slider->status == 1)
                    <option value="1" selected>Active</option>
                    <option value="0">Disable</option>
                    @else
                    <option value="1">Active</option>
                    <option value="0" selected>Disable</option>
                    @endif

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


@endsection
<!-- Additional JS -->
@push('Backend_javaScript')
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
	$('#example').DataTable();
  } );
</script>
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
               
           },
           messages :{
               slider_title_en: {
                   required : 'Please Enter slider Title En',
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

@endpush

@extends('backend.admin.layouts.master')
<!-- Main Content -->
@section('page_content')
<div class="page-content">
  <!--breadcrumb-->
  <div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
             <a href="{{ route('brand.index') }}" class="btn btn-primary">All Brand</a>
               
            </div>
        </div>
    </div>
    <hr/>
  <!--end breadcrumb-->
  <div class="container">
     <div class="main-body">
        <div class="row">
           <div class="col-lg-10">
              <div class="card">
                 <div class="card-body">
                  <form id="myForm" method="post" action="{{ route('brand.store') }}" enctype="multipart/form-data">
                    @csrf
                       <div class="row mb-3">
                          <div class="col-sm-3">
                             <h6 class="mb-0">Brand Name En</h6>
                          </div>
                          <div class="form-group col-sm-9 text-secondary">
                             <input type="text" name="brand_name_en" class="form-control"   />
                          </div>
                       </div>
                       @error('brand_name_en')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                       <div class="row mb-3">
                          <div class="col-sm-3">
                             <h6 class="mb-0">Brand Name Bn</h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                             <input type="text" name="brand_name_bn" class="form-control"   />
                          </div>
                       </div>
                       @error('brand_name_bn')
                       <span class="text-danger">{{ $message }}</span>
                       @enderror
                       <div class="row mb-3">
                          <div class="col-sm-3">
                             <h6 class="mb-0">Brand Image </h6>
                          </div>
                          <div class="col-sm-9 text-secondary">
                             <input type="file" name="brand_image" class="form-control"  id="image"   />
                          </div>
                        @error('brand_image')
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
              brand_name_en: {
                  required : true,
              }, 
          },
          messages :{
              brand_name_en: {
                  required : 'Please Enter Brand Name',
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
@endsection


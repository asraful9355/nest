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
        <div class="breadcrumb-title pe-3">Edit Brand</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Brand</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
             <a href="{{ route('brand.create') }}" class="btn btn-primary">Add Brand</a>
               
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
   
    <hr/>
    <div class="card">
        <div class="card-body">
          <form method="post" action="{{ route('brand.update',$brand->id) }}" enctype="multipart/form-data">
            @csrf
               <div class="row mb-3">
                  <div class="col-sm-3">
                     <h6 class="mb-0">Brand Name En</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <input type="text" name="brand_name_en" class="form-control"  value="{{ $brand->brand_name_en}}" />
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
                     <input type="text" name="brand_name_bn" class="form-control" value="{{ $brand->brand_name_bn}}" />
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
                     <input type="file" name="brand_image" class="form-control"  id="image"/>
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
                     <img id="showImage" src="{{ asset($brand->brand_image) }}" alt="Admin" style="width:100px; height: 100px;">
                  </div>
               </div>

               <div class="row mb-3">
                <div class="col-sm-3">
                   <h6 class="mb-0">Status</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <select name="status" id="status" class="form-control">
                    @if ($brand->status == 1)
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
@endpush

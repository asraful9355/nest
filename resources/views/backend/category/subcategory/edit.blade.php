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
      <div class="breadcrumb-title pe-3">Edit SubCategory </div>
      <div class="ps-3">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
               <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
               </li>
               <li class="breadcrumb-item active" aria-current="page">Edit SubCategory </li>
            </ol>
         </nav>
      </div>
      <div class="ms-auto">
         <div class="btn-group">
            <a href="{{ route('subcategory.index') }}" class="btn btn-primary">All Sub Category</a>
              
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
                     <form  method="post" action="{{ route('subcategory.update',$subcategory->id) }}"   >
                        @csrf
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Category Name</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="category_id" class="form-select mb-3" aria-label="Default select example">
                                 <option selected="">Open this select menu</option>
                                 @foreach($categories as $category)
                                 <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected' : '' }} >{{ $category->category_name_en }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">SubCategory Name En</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="subcategory_name_en" class="form-control" value="{{ $subcategory->subcategory_name_en }}"   />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">SubCategory Name Bn</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <input type="text" name="subcategory_name_bn" class="form-control" value="{{ $subcategory->subcategory_name_bn }}"   />
                           </div>
                        </div>
                        <div class="row mb-3">
                           <div class="col-sm-3">
                              <h6 class="mb-0">Status</h6>
                           </div>
                           <div class="form-group col-sm-9 text-secondary">
                              <select name="status" id="status" class="form-control">
                                 @if ($subcategory->status == 1)
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
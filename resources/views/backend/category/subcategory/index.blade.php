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
       <div class="breadcrumb-title pe-3">All SubCategory</div>
       <div class="ps-3">
          <nav aria-label="breadcrumb">
             <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">All SubCategory</li>
             </ol>
          </nav>
       </div>
       <div class="ms-auto">
          <div class="btn-group">
             <a href="{{ route('subcategory.create') }}" class="btn btn-primary">Add SubCategory</a> 				 
          </div>
       </div>
    </div>
    <!--end breadcrumb-->
    <hr/>
    <div class="card">
       <div class="card-body">
          <div class="table-responsive">
             <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                   <tr>
                      <th>Sl</th>
                      <th>Category Name En </th>
                      <th>Category Name Bn </th>
                      <th>SubCategory Name En </th>
                      <th>SubCategory Name Bn</th>
                      <th>Status</th>
                      <th>Action</th>
                   </tr>
                </thead>
                <tbody>
                   @foreach($subcategories as $key => $item)		
                   <tr>
                      <td> {{ $key+1 }} </td>
                      <td>{{  $item->category->category_name_en ?? 'NULL' }}</td>
                      <td>{{  $item->category->category_name_bn ?? 'NULL' }}</td>
                      <td> {{ $item->subcategory_name_en }}  </td>
                      <td> {{ $item->subcategory_name_bn }}  </td>
                      <td>  

                        @if($item->status == 1)
                        <a href="{{ route('subcategory.in_active',['id'=>$item->id]) }}" class="badge btn-success p-2 m-2">Active</a>
                        @else
                          <a href="{{ route('subcategory.active',['id'=>$item->id]) }}" class="badge btn-danger p-2 m-2">Disable</a>
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('subcategory.edit',$item->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>

                        <a href="{{ route('subcategory.delete',$item->id) }}"class="btn btn-danger" title="Delete Data" id="delete"><i class="fa fa-trash"></i></a>
                      </td>
                   </tr>
                   @endforeach
                </tbody>
                <tfoot>
                   <tr>
                      <th>Sl</th>
                      <th>Category Name En</th>
                      <th>Category Name Bn</th>
                      <th>SubCategory Name En</th>
                      <th>SubCategory Name Bn</th>
                      <th>Action</th>
                   </tr>
                </tfoot>
             </table>
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

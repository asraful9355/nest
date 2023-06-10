<!-- Bootstrap JS -->
<script src="{{ asset('backend') }}/assets/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{ asset('backend') }}/assets/js/jquery.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/chartjs/js/Chart.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-knob/excanvas.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/jquery-knob/jquery.knob.js"></script>
<script>
   $(function() {
       $(".knob").knob();
   });
</script>
<script src="{{ asset('backend') }}/assets/js/index.js"></script>
<script src="{{ asset('backend') }}/assets/js/validate.min.js"></script>
<!--app JS-->
<script src="{{ asset('backend') }}/assets/js/app.js"></script>
{{-- add js --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- all toastr message show  Update-->
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
<!-- all toastr message show  old-->
<script type="text/javascript">
   @if(Session::has('success'))
     toastr.success("{{Session::get('success')}}");
   @endif
   @if(Session::has('info'))
     toastr.info("{{Session::get('info')}}");
   @endif
   @if(Session::has('warning'))
     toastr.warning("{{Session::get('warning')}}");
   @endif
   @if(Session::has('error'))
     toastr.info("{{Session::get('error')}}");
   @endif
   @if(Session::has('danger'))
     toastr.danger("{{Session::get('danger')}}");
   @endif
</script>
<!-- sweetalerat link -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="{{ asset('backend') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('backend') }}/assets/plugins/datatable/js/dataTables.bootstrap5.min.js"></script>
<script>
  $(document).ready(function() {
	$('#example').DataTable();
  } );
</script>

<!-- tag er jonne neowa atuko -->
<script src="{{ asset('backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>

<script>
 tinymce.init({
   selector: '.mytextarea'
 });
</script>

<!-- Image Show Script -->
<script type="text/javascript">
  $(document).ready(function() {
      $('#image').change(function(e) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#showImage').attr('src', e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
      });
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
      $('#img').change(function(e) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#show').attr('src', e.target.result);
          }
          reader.readAsDataURL(e.target.files['0']);
      });
  });
</script>

<!-- sweetalerat delete data -->
<script type="text/javascript">
  $(function(){
      $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");
  
        Swal.fire({
        title: 'Are you sure?',
        text: "Delete This Data!",
        icon: 'danger',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
      if (result.isConfirmed) {
          window.location.href = link
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    });
  });
</script>


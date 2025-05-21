{{-- <script src="/theme/assets/plugins/jquery/jquery-3.4.1.min.js"></script> --}}
{{-- <script src="https://unpkg.com/@popperjs/core@2"></script> --}}
<script src="/theme/assets/js/popper.min.js"></script>
<script src="/theme/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="/theme/assets/js/feather.min.js"></script>
{{-- <script src="https://unpkg.com/feather-icons"></script> --}}
<script src="/theme/assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script src="/theme/assets/plugins/DataTables/datatables.min.js"></script>
<script src="/theme/assets/js/main.min.js"></script>
<script src="/theme/assets/js/pages/datatables.js"></script>

{{-- <script src="/theme/assets/js/pages/dashboard.js"></script> --}}


<script>
    @if (session('success'))
        Swal.fire({
          position: "top-center",
          text: "Success",
          icon: "success",
          title: "{{ Session::get('success') }}",
          showConfirmButton: false,
          timer: 3500
        });
    @endif
</script>

<script>
    @if (session('error'))
        Swal.fire({
          position: "top-center",
          text: "Upss Sorry !",
          icon: "error",
          title: "{{ Session::get('error') }}",
          showConfirmButton: false,
          timer: 5500
        });
    @endif
</script>

<script>
    @if (session('status'))
        Swal.fire({
          position: "top-center",
          text: "Success",
          icon: "success",
          title: "{{ Session::get('status') }}",
          showConfirmButton: false,
          timer: 3500
        });
    @endif
</script>


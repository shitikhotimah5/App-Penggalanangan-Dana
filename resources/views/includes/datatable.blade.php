@push('css_vendor')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/AdminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush




@push('scripts_vendor')
<!-- DataTables -->
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('/AdminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endpush

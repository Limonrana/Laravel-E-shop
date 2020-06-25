<script src="{{ asset('backend/lib/jquery/jquery.js') }}"></script>
<script src="{{ asset('backend/lib/popper.js/popper.js') }}"></script>
<script src="{{ asset('backend/lib/bootstrap/bootstrap.js') }}"></script>
<script src="{{ asset('backend/lib/jquery-ui/jquery-ui.js') }}"></script>
<script src="{{ asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
<script src="{{ asset('backend/lib/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('backend/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
<script src="{{ asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('backend/lib/d3/d3.js') }}"></script>
<script src="{{ asset('backend/lib/rickshaw/rickshaw.min.js') }}"></script>
<script src="{{ asset('backend/lib/chart.js/Chart.js') }}"></script>
<script src="{{ asset('backend/lib/Flot/jquery.flot.js') }}"></script>
<script src="{{ asset('backend/lib/Flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('backend/lib/Flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>

<script src="{{ asset('backend/js/starlight.js') }}"></script>
<script src="{{ asset('backend/js/ResizeSensor.js') }}"></script>
<script src="{{ asset('backend/js/dashboard.js') }}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js')}}"></script>

<script>
    $(function(){
        'use strict';

        $('#datatable1').DataTable({
            responsive: true,
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
                lengthMenu: '_MENU_ items/page',
            }
        });

    });
</script>

<script>
        @if(Session::has('messege'))
    var type="{{Session::get('alert-type','info')}}"
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
        case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
        case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
        case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
    }
    @endif
</script>

<script>
    $(document).on("click", "#delete", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you want to delete?",
            text: "Once Delete, This will be Permanently Delete!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe Data!");
                }
            });
    });

    $(document).on("click", "#cancel", function(e){
        e.preventDefault();
        var link = $(this).attr("href");
        swal({
            title: "Are you want to cancel order?",
            text: "Once cancel, This will be permanently cancel!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if (willDelete) {
                    window.location.href = link;
                } else {
                    swal("Safe your Order!");
                }
            });
    });
</script>
@yield('admin-js')
</body>
</html>

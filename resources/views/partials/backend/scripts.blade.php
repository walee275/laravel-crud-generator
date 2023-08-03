<!-- Bootstrap core JavaScript-->
<script src="{{ asset('new_template/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('new_template/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('new_template/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('new_template/assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
{{-- <script src="{{ asset('new_template/assets/vendor/chart.js/Chart.min.js') }}"></script> --}}

{{-- <!-- Page level custom scripts -->
<script src="{{ asset('new_template/assets/js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('new_template/assets/js/demo/chart-pie-demo.js') }}"></script> --}}
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>


@yield('scripts')

<script>
    // $(document).ready(function() {
    //     // Make a GET request to a service that returns the user's IP address
    //     $.get("https://api.ipify.org?format=json", function(data) {
    //         // Handle the response and display the user's IP address
    //         $.get("https://freegeoip.app/json/" + data.ip, function(data) {
    //             // Handle the response and display the result
    //             $.get(`https://geocode.maps.co/reverse?lat=${data.latitude}&lon=${data.longitude}`, function(data){
    //                 consoel.log(data.address.country);
    //             });
    //             console.log("Country: " + data.country_name + "City: " + data.city)
    //             $("#ipAddress").html("Country: " + data.country_name + "<br>City: " + data.city);
    //         });
    //         // $("#ipAddress").html("Your IP Address: " + data.ip);
    //     });



    // });
</script>

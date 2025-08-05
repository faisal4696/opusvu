<!-- Bootstrap core JavaScript-->
<script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
<script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>

<!--- file uploader links --->
<script src="{{ asset('js/dropzone.min.js') }}"></script>
<script src="{{ asset('js/upload.js') }}"></script>

<script type="text/javascript">
    setTimeout(function() {
        $('.alert').fadeOut('fast');
    }, 2000); // <-- time in milliseconds

    $(document).ready(function(){
        // search code
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });

        $('.body .view-categories').click(function(){
            $('.body .view-categories').addClass('active');
        });
        $('.body .view-users').click(function(){
            $('.body .view-users').addClass('active');
        });
        $('.body .view-videos').click(function(){
            $('.body .view-videos').addClass('active');
        });

            $("tr:odd").css({
                "background-color":"#111",
                });
        $("tr:even").css({
            "background-color":"#333",
        });

        $(".stopVideo").on('click',function (){
            $(".video").trigger("pause");
        });

    });
</script>

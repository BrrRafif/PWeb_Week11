</div>
<footer>
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>

        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
        <script>
            $(document).ready(function() {
                $("#menu-toggle").click(function(e) {
                    e.preventDefault();
                    $("#wrapper").toggleClass("toggled");
                });
            });
        </script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h4 style="margin-top: 0;">Laundry Crafty</h4>
                <p><small>Sistem Manajemen Laundry Sederhana & Efisien.</small></p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <small>&copy; <?php echo date("Y"); ?> Laundry Crafty. Versi 1.0</small>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
    <script src="<?= base_url('/assets/vendor/jquery/jquery.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
    <script src="<?= base_url('/assets/js/sb-admin-2.min.js') ?>"></script>
    <script src="<?= base_url('/assets/vendor/chart.js/Chart.min.js') ?>"></script>
    <!-- <script src="<?= base_url('/assets/js/demo/chart-area-demo.js') ?>"></script> -->
    <!-- <script src="<?= base_url('/assets/js/demo/chart-pie-demo.js') ?>"></script> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>

    <script>
        new Cleave('#cpf', {
            blocks: [3, 3, 3, 2],
            delimiters: ['.', '.', '-'],
            numericOnly: true
        });

        new Cleave('#contact', {
            delimiters: ['(', ') ', '-'],
            blocks: [0, 2, 5, 4],
            numericOnly: true,
            delimiterLazyShow: true
        });
    </script>
    </body>

    </html>
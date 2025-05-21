<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="Bootstrap Admin App">
    <meta name="keywords" content="app, responsive, jquery, bootstrap, dashboard, admin">
    <link rel="icon" type="image/x-icon" href="favicon.ico">

    <base href="<?= $racineWeb ?>" >

    <!-- FONT AWESOME-->
    <link rel="stylesheet" href="Content/vendor/@fortawesome/fontawesome-free/css/brands.css">
    <link rel="stylesheet" href="Content/vendor/@fortawesome/fontawesome-free/css/regular.css">
    <link rel="stylesheet" href="Content/vendor/@fortawesome/fontawesome-free/css/solid.css">
    <link rel="stylesheet" href="Content/vendor/@fortawesome/fontawesome-free/css/fontawesome.css"><!-- SIMPLE LINE ICONS-->
    <link rel="stylesheet" href="Content/vendor/simple-line-icons/css/simple-line-icons.css"><!-- ANIMATE.CSS-->
    <link rel="stylesheet" href="Content/vendor/animate.css/animate.css"><!-- WHIRL (spinners)-->
    <link rel="stylesheet" href="Content/vendor/whirl/dist/whirl.css"><!-- =============== PAGE VENDOR STYLES ===============-->

    <!-- TAGS INPUT-->
    <link rel="stylesheet" href="Content/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"><!-- SLIDER CTRL-->
    <link rel="stylesheet" href="Content/vendor/bootstrap-slider/dist/css/bootstrap-slider.css"><!-- CHOSEN-->
    <link rel="stylesheet" href="Content/vendor/chosen-js/chosen.css"><!-- DATETIMEPICKER-->
    <link rel="stylesheet" href="Content/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.css"><!-- COLORPICKER-->
    <link rel="stylesheet" href="Content/vendor/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css">

    <!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="Content/css/bootstrap.css" id="bscss"><!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="Content/css/app.css" id="maincss">

    <!-- Datatables-->
    <link rel="stylesheet" href="Content/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="Content/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">

    <!-- SELECT2-->
    <link rel="stylesheet" href="Content/vendor/select2/dist/css/select2.css">
    <link rel="stylesheet" href="Content/vendor/%40ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css">


    <link rel="stylesheet" href="Content/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css"><!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="Content/css/bootstrap.css" id="bscss"><!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="Content/css/app.css" id="maincss">

    <!-- Titre -->
    <title>Primo Annonces - <?= $titre ?></title>
</head>
<body>
<div class="wrapper">

            <?= $contenu ?>

    <?php require 'Shared/Footer.php'; ?>

</div>


<!-- =============== VENDOR SCRIPTS ===============-->
<!-- MODERNIZR-->
<script src="Content/vendor/modernizr/modernizr.custom.js"></script><!-- STORAGE API-->
<script src="Content/vendor/js-storage/js.storage.js"></script><!-- SCREENFULL-->
<script src="Content/vendor/screenfull/dist/screenfull.js"></script><!-- i18next-->
<script src="Content/vendor/i18next/i18next.js"></script>
<script src="Content/vendor/i18next-xhr-backend/i18nextXHRBackend.js"></script>
<script src="Content/vendor/jquery/dist/jquery.js"></script>
<script src="Content/vendor/popper.js/dist/umd/popper.js"></script>
<script src="Content/vendor/bootstrap/dist/js/bootstrap.js"></script><!-- =============== PAGE VENDOR SCRIPTS ===============-->
<!-- PARSLEY-->
<script src="Content/vendor/parsleyjs/dist/parsley.js"></script>

<!-- Datatables-->
<script src="Content/vendor/datatables.net/js/jquery.dataTables.js"></script>
<script src="Content/vendor/datatables.net-bs4/js/dataTables.bootstrap4.js"></script>
<script src="Content/vendor/datatables.net-buttons/js/dataTables.buttons.js"></script>
<script src="Content/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.js"></script>
<script src="Content/vendor/datatables.net-buttons/js/buttons.colVis.js"></script>
<script src="Content/vendor/datatables.net-buttons/js/buttons.flash.js"></script>
<script src="Content/vendor/datatables.net-buttons/js/buttons.html5.js"></script>
<script src="Content/vendor/datatables.net-buttons/js/buttons.print.js"></script>
<script src="Content/vendor/datatables.net-keytable/js/dataTables.keyTable.js"></script>
<script src="Content/vendor/datatables.net-responsive/js/dataTables.responsive.js"></script>
<script src="Content/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="Content/vendor/jszip/dist/jszip.js"></script>
<script src="Content/vendor/pdfmake/build/pdfmake.js"></script>

<!-- FILESTYLE-->
<script src="Content/vendor/bootstrap-filestyle/src/bootstrap-filestyle.js"></script><!-- TAGS INPUT-->
<script src="Content/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script><!-- CHOSEN-->
<script src="Content/vendor/chosen-js/chosen.jquery.js"></script><!-- SLIDER CTRL-->
<script src="Content/vendor/bootstrap-slider/dist/bootstrap-slider.js"></script>

<!-- FILESTYLE-->
<script src="Content/vendor/bootstrap-filestyle/src/bootstrap-filestyle.js"></script>
<!-- TAGS INPUT-->
<script src="Content/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script><!-- CHOSEN-->
<script src="Content/vendor/chosen-js/chosen.jquery.js"></script><!-- SLIDER CTRL-->
<script src="Content/vendor/bootstrap-slider/dist/bootstrap-slider.js"></script><!-- INPUT MASK-->
<script src="Content/vendor/inputmask/dist/jquery.inputmask.bundle.js"></script><!-- WYSIWYG-->
<script src="Content/vendor/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script><!-- MOMENT JS-->
<script src="Content/vendor/moment/min/moment-with-locales.js"></script><!-- DATETIMEPICKER-->
<script src="Content/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script><!-- COLORPICKER-->
<script src="Content/vendor/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>

<!-- SELECT2-->
<script src="Content/vendor/select2/dist/js/select2.full.js"></script>

<!-- =============== APP SCRIPTS ===============-->
<script src="Content/js/app.js"></script>

<!-- Select2 -->
<script>
    $(document).ready(function () {
        $(".select2-1").select2({
            theme: "bootstrap4"
            //minimumInputLength: 2
        });
        $(".select2_group").select2({});

        $(".select2_multiple").select2({
            allowClear: true,
            maximumSelectionLength: 10,
            allowClear: true,
            minimumSelectionLength: 1,
            theme: "material"
            //maximumSelectionLength: 10,
        });
    });

</script>
<!-- /Select2  -->

</body>
</html>

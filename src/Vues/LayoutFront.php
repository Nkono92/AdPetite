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

    <!-- Datatables-->
    <link rel="stylesheet" href="Content/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="Content/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">
    <link rel="stylesheet" href="Content/vendor/datatables.net-responsive-bs/css/responsive.bootstrap.css"><!-- =============== BOOTSTRAP STYLES ===============-->
    <link rel="stylesheet" href="Content/css/bootstrap.css" id="bscss"><!-- =============== APP STYLES ===============-->
    <link rel="stylesheet" href="Content/css/appbis.css" id="maincss">


    <link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="Assets/fonts/line-icons.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/slicknav.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/color-switcher.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/nivo-lightbox.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/animate.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/owl.carousel.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/main.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/responsive.css">

    <link rel="stylesheet" type="text/css" href="Assets/css/summernote.css">



    <!-- SELECT2-->
    <link rel="stylesheet" href="Content/vendor/select2/dist/css/select2Bis.css">
    <link rel="stylesheet" href="Content/vendor/%40ttskch/select2-bootstrap4-theme/dist/select2-bootstrap4.css">


    <!-- Datatables-->
    <link rel="stylesheet" href="Content/vendor/datatables.net-bs4/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="Content/vendor/datatables.net-keytable-bs/css/keyTable.bootstrap.css">


    <!--Upload File Previewer START-->

    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700" rel="stylesheet">
    <link href="Assets/css/fileUpload/main.upload.css" rel="stylesheet">

    <!-- Fine Uploader New/Modern CSS file
    ====================================================================== -->
    <link href="Assets/css/fileUpload/fine-uploader-new.css" rel="stylesheet">

    <!-- Fine Uploader JS file
    ====================================================================== -->
    <script src="Assets/js/fileUpload/fine-uploader.js"></script>

    <!-- Fine Uploader Thumbnails template w/ customization
    ====================================================================== -->
    <script type="text/template" id="qq-template-manual-trigger">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Déposez les images secondaires ici">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons" style="width: 100%">
                <div class="qq-upload-button-selector qq-upload-button" style="width: 100%; border-radius: 50px; color: #fff;position: relative; background-color: #00BCD4; -webkit-transition: all .2s ease-in-out;">
                    <div>Sélectionnez ou déposez les fichiers</div>
                </div>
                <!--<button type="button" id="trigger-upload" class="btn btn-primary">
                    <i class="icon-upload icon-white"></i> Upload
                </button>-->
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename"  accept="image/png, image/jpeg" multiple name="PieceJointeSecondaires[]" tabindex="0" type="file">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancel</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Retry</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Delete</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Close</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">No</button>
                    <button type="button" class="qq-ok-button-selector">Yes</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancel</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>

    <style>
        #trigger-upload {
            color: white;
            background-color: #00ABC7;
            font-size: 14px;
            padding: 7px 20px;
            background-image: none;
        }

        #fine-uploader-manual-trigger .qq-upload-button {
            margin-right: 15px;
        }

        #fine-uploader-manual-trigger .buttons {
            width: 36%;
        }

        #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
            width: 60%;
        }
    </style>

    <!--Upload File Previewer END-->

    <!-- Titre -->
    <title><?= $titre ?></title>
</head>
<body>
<div class="wrapper">

            <?= $contenu ?>

    <?php require 'Shared/FooterFront.php'; ?>


    <a href="#" class="back-to-top">
        <i class="lni-chevron-up"></i>
    </a>

    <div id="preloader">
        <div class="loader" id="loader-1"></div>
    </div>

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

<!-- SELECT2-->
<script src="Content/vendor/select2/dist/js/select2.full.js"></script>


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


<!-- TAGS INPUT START-->
<script src="Assets/js/jquery.mask.js"></script>

<!--<script type="text/javascript" >
    $(document).ready(function(){
        $('#Telephone').mask('(+237) 999-999-999');
    });
</script>-->
<!-- TAGS INPUT END-->

<!-- =============== APP SCRIPTS ===============-->
<script src="Content/js/app.js"></script>

<!--<script src="Assets/js/jquery-min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/popper.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/bootstrap.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>-->
<script src="Assets/js/color-switcher.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/jquery.counterup.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/waypoints.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/wow.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/owl.carousel.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/nivo-lightbox.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/jquery.slicknav.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/main.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/form-validator.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/contact-form-script.min.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/js/summernote.js" type="51f69dc2bbca002b9fc5ba09-text/javascript"></script>
<script src="Assets/ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="51f69dc2bbca002b9fc5ba09-|49" defer=""></script>



<!--Upload File Previewer START-->


<script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fetch/2.0.3/fetch.js"></script>
<script type="text/javascript" src="Assets/js/fileUpload/vendor.upload.js"></script>
<script type="text/javascript" src="Assets/js/fileUpload/main.upload.js"></script>

<script>
    var manualUploader = new qq.FineUploader({
        element: document.getElementById('fine-uploader-manual-trigger'),
        template: 'qq-template-manual-trigger',
        request: {
            endpoint: '/server/uploads'
        },
        thumbnails: {
            placeholders: {
                waitingPath: '/source/placeholders/waiting-generic.png',
                notAvailablePath: '/source/placeholders/not_available-generic.png'
            }
        },
        autoUpload: false,
        debug: true
    });

    qq(document.getElementById("trigger-upload")).attach("click", function () {
        manualUploader.uploadStoredFiles();
    });
</script>
<!--Upload File Previewer END-->

<script type="text/javascript">
    function PrintDiv(divName)
    {
        /*var divContents = document.getElementById("printdivcontent").innerHTML;
        var printWindow = window.open('', '', 'height=200,width=400');
        printWindow.document.write('<html><head><title>Print DIV Content</title>');
        printWindow.document.write('</head><body >');
        printWindow.document.write(divContents);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();*/

        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;

    }
</script>

</body>
</html>

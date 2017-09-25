<!--<script src="assets/admin/js/jquery.2.1.1.min.js" type="text/javascript"></script>-->
<!-- jQuery -->
<!--<script src="assets/admin/bower_components/jquery/dist/jquery.min.js"></script>-->
<!-- Bootstrap Core JavaScript -->
<script src="assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="assets/admin/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<!--slimscroll JavaScript -->
<script src="assets/admin/js/jquery.slimscroll.js" type="text/javascript"></script>
<!--Wave Effects -->
<script src="assets/admin/js/waves.js" type="text/javascript"></script>
<!-- Flot Charts JavaScript -->
<script src="assets/admin/bower_components/flot/jquery.flot.js"></script>
<script src="assets/admin/bower_components/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<!-- google maps api -->
<script src="assets/admin/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="assets/admin/bower_components/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Sparkline charts -->
<script src="assets/admin/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
<!-- EASY PIE CHART JS -->
<script src="assets/admin/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>
<script src="assets/admin/bower_components/jquery.easy-pie-chart/easy-pie-chart.init.js"></script>
<!-- Custom Theme JavaScript -->

<script src="assets/admin/bower_components/datatables/jquery.dataTables.min.js"></script>

<script src="assets/admin/js/custom.min.js" type="text/javascript"></script>

<script src="assets/admin/bower_components/dropzone-master/dist/dropzone.js" type="text/javascript"></script>

<script src="assets/admin/js/jasny-bootstrap.js"></script>
<script src="assets/admin/js/dashboard2.js" type="text/javascript"></script>
<!--Style Switcher -->
<script src="assets/admin/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

<script src="assets/admin/bower_components/dropify/dist/js/dropify.min.js"></script>

<script src="assets/admin/bower_components/moment/moment.js"></script>
<!-- Clock Plugin JavaScript -->
<script src="assets/admin/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
<!-- Color Picker Plugin JavaScript -->
<script src="assets/admin/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
<script src="assets/admin/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
<script src="assets/admin/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
<!-- Date Picker Plugin JavaScript -->
<script src="assets/admin/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
<!-- Date range Plugin JavaScript -->
<script src="assets/admin/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
<script src="assets/admin/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<script src="assets/admin/bower_components/switchery/dist/switchery.min.js"></script>
<script src="assets/admin/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
<script src="assets/admin/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
<script src="assets/admin/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="assets/admin/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script type="text/javascript" src="assets/admin/bower_components/multiselect/js/jquery.multi-select.js"></script>

<!---------------------------BOOTSTREP RATING MASTER----------------------------->
<script src="<?php echo base_url() ?>assets/front/starrating/js/star-rating.min.js"></script>
<script src="<?php echo base_url() ?>assets/front/starrating/themes/krajee-svg/theme.js" type="text/javascript"></script>

<!---------------------------LIGHT GALLERY MASTER----------------------------->
<!--<script src="<?php echo base_url() ?>assets/front/lightbox/dist/js/lightbox-plus-jquery.min.js"></script>-->

<!---------------------------------JQUERY VALIDATION---------------------------->
<script src="<?php echo base_url() ?>assets/validate/jquery.validate.min.js"></script>

<script>
    jQuery(document).ready(function () {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());

        });
        // For select 2

        $(".select2").select2();
        $('.selectpicker').selectpicker();

        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }

        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();

        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });

        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });

        // For multiselect

        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({selectableOptgroup: true});

        $('#public-methods').multiSelect();
        $('#select-all').click(function () {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function () {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function () {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function () {
            $('#public-methods').multiSelect('addOption', {value: 42, text: 'test 42', index: 0});
            return false;
        });

    });

</script>

<script src="assets/admin/bower_components/summernote/dist/summernote.min.js"></script>
<script>

    jQuery(document).ready(function () {

        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false                 // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    window.edit = function () {
        $(".click2edit").summernote()
    },
            window.save = function () {
                $(".click2edit").destroy()
            }
</script>

<script>
    $('select').change(function () {
        if ($(this).val() == "add_extra") {
            $('#my_modal').modal('show');
        }
    });
</script>


<script>

    var sub_img = 0;
    var p_file = 0;
    $(document).on('mouseover', '.dropify', function () {
        $(this).dropify();
    });
    $(document).on('focus', '.dropify', function () {
        $(this).dropify();
    });
    var img_extn = ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG'];

    function image_hover(color_code) {
        document.getElementById('add_img_div').style.backgroundColor = color_code;
    }

    function add_images() {
        sub_img++;
        var addImg = '<div  class="form-group col-md-3 ">'
                + '<input type="file" id="sub_img_' + sub_img + '" data-height="150" class="dropify" name="userfile[]" data-default-file="">'
                + '<span id="img_err" style="color: red;">'
                + '<?php echo form_error('sub_img'); ?>'
                + '</span>'
                + '</div>';
        $('#add_images_div').before(addImg);
        $('#sub_img_' + sub_img).focus();
    }

</script>










<script>
    $(document).ready(function () {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function (event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function (event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function (event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function (e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
</script>

<link href="<?php echo base_url() ?>assets/front/FlexSlider/flexslider.css" id="theme"  rel="stylesheet">
<script src="<?php echo base_url() ?>assets/front/FlexSlider/jquery.flexslider-min.js"></script>
<script>
    $(document).ready()
    {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    }
    );
    $(document).ready(function () {
        $('#myTable').DataTable();
        $(document).ready(function () {
            var table = $('#example').DataTable({
                "columnDefs": [
                    {"visible": false, "targets": 2}
                ],
                "order": [[2, 'asc']],
                "displayLength": 25,
                "drawCallback": function (settings) {
                    var api = this.api();
                    var rows = api.rows({page: 'current'}).nodes();
                    var last = null;

                    api.column(2, {page: 'current'}).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                    '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                                    );

                            last = group;
                        }
                    });
                }
            });

            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>


<script>
// Clock pickers
    $('#single-input').clockpicker({
        placement: 'bottom',
        align: 'left',
        autoclose: true,
        'default': 'now'

    });

    $('.clockpicker').clockpicker({
        donetext: 'Done',
    })
            .find('input').change(function () {
        console.log(this.value);
    });

    $('#check-minutes').click(function (e) {
        // Have to stop propagation here
        e.stopPropagation();
        input.clockpicker('show')
                .clockpicker('toggleView', 'minutes');
    });
    if (/mobile/i.test(navigator.userAgent)) {
        $('input').prop('readOnly', true);
    }
// Colorpicker

    $(".colorpicker").asColorPicker();
    $(".complex-colorpicker").asColorPicker({
        mode: 'complex'
    });
    $(".gradient-colorpicker").asColorPicker({
        mode: 'gradient'
    });
// Date Picker
    jQuery('.mydatepicker, #datepicker').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true
    });
    jQuery('#datepicker-autoclose').datepicker({
        autoclose: true,
        todayHighlight: true
    });

    jQuery('#date-range').datepicker({
        toggleActive: true
    });
    jQuery('.datepicker-inline').datepicker({
        autoclose: true,
        format: 'yyyy/mm/dd',
        todayHighlight: true
    });

// Daterange picker

    $('.input-daterange-datepicker').daterangepicker({
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-daterange-timepicker').daterangepicker({
        timePicker: true,
        format: 'MM/DD/YYYY h:mm A',
        timePickerIncrement: 30,
        timePicker12Hour: true,
        timePickerSeconds: false,
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse'
    });
    $('.input-limit-datepicker').daterangepicker({
        format: 'MM/DD/YYYY',
        minDate: '06/01/2015',
        maxDate: '06/30/2015',
        buttonClasses: ['btn', 'btn-sm'],
        applyClass: 'btn-danger',
        cancelClass: 'btn-inverse',
        dateLimit: {
            days: 6
        }
    });

</script>

<scritp type="text/javascript">
    <!--    $(document).ready() {
        $('.flexslider').flexslider({
        animation: "slide"
        });
        });-->
</scritp>

<footer class="footer text-center"> 2016 &copy; Elite Admin brought to you by themedesigner.in </footer>
</body> 
</html>
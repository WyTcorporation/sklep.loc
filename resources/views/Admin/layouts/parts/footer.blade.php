<footer class="main-footer">
    <strong>Copyright &copy; 2011-2022 <a href="http://lockIt.com.ua">LockIt.com.ua</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.5
    </div>
</footer>


<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- Select2 -->
<script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>
<!-- InputMask -->
<script src="{{asset('plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('plugins/inputmask/jquery.inputmask.min.js')}}"></script>
<!-- date-range-picker -->
<script src="{{asset('plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Bootstrap Switch -->
<script src="{{asset('plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<!-- BS-Stepper -->
<script src="{{asset('plugins/bs-stepper/js/bs-stepper.min.js')}}"></script>
<!-- dropzonejs -->
<script src="{{asset('plugins/dropzone/dropzone.js')}}"></script>
<!-- bs-custom-file-input -->
<script src="{{asset('plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
<!-- DataTables  & Plugins -->
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
{{--<!-- AdminLTE for demo purposes -->--}}
{{--<script src="{{asset('dist/js/demo.js')}}"></script>--}}
<!-- Page specific script -->
<!-- Summernote -->
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- CodeMirror -->
<script src="{{asset('plugins/codemirror/codemirror.js')}}"></script>
<script src="{{asset('plugins/codemirror/mode/css/css.js')}}"></script>
<script src="{{asset('plugins/codemirror/mode/xml/xml.js')}}"></script>
<script src="{{asset('plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

        $('#np').select2({
            placeholder: 'Select an service',
            ajax: {
                url: '{{route('np.city')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    const entries = Object.values(data.data);
                    //console.log(entries);
                    return {
                        results: entries
                    };
                },
                cache: false
            }
        });
        $('#np').on("select2:selecting", function (e) {
            $('#np-warehouses').select2({
                placeholder: 'Select an service',
                ajax: {
                    url: '{{route('np.warehouses')}}',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        var search = $('#np').select2('data')[0].text;
                        var id = $('#np').select2('data')[0].id;
                        //console.log(search);
                        // console.log($('#np').select2('data'));
                        var query = {
                            search: search,
                            id: id
                        }

                        return query;
                    },
                    processResults: function (data) {
                        const entries = Object.values(data.data);
                        console.log(entries);
                        return {
                            results: entries
                        };
                    },
                    cache: false
                }
            });
        });

        $('#np-warehouses').select2({
            placeholder: 'Select an service',
            ajax: {
                url: '{{route('np.warehouses')}}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var search = $('#np').select2('data')[0].text;
                    var id = $('#np').select2('data')[0].id;
                    // console.log(search);
                    // console.log($('#np').select2('data'));
                    var query = {
                        search: search,
                        id: id
                    }

                    return query;
                },
                processResults: function (data) {
                    const entries = Object.values(data.data);
                    console.log(entries);
                    return {
                        results: entries
                    };
                },
                cache: false
            }
        });

        $('#products').select2({
            placeholder: 'Select an service',
            ajax: {
                url: '{{route('api.products.search')}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    const entries = Object.values(data.data);
                    console.log(entries);
                    return {
                        results: entries
                    };
                },
                cache: false
            }
        });

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {'placeholder': 'dd/mm/yyyy'})
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'})
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
            // format: 'L'
            format: 'YYYY-MM-DD',
            icons: {time: 'far fa-clock'}
        });
        $('#reservationdate2').datetimepicker({
            // format: 'L'
            format: 'YYYY-MM-DD',
            icons: {time: 'far fa-clock'}
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({icons: {time: 'far fa-clock'}});

        //Date range picker
        $('#reservation').daterangepicker()
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({
            timePicker: true,
            timePickerIncrement: 30,
            locale: {
                format: 'MM/DD/YYYY hh:mm A'
            }
        })
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            }
        )

        //Timepicker
        $('#timepicker').datetimepicker({
            format: 'LT'
        })

        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()

        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon
        $('.my-colorpicker2').colorpicker()

        $('.my-colorpicker2').on('colorpickerChange', function (event) {
            $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
        })

        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

        bsCustomFileInput.init();


        // Summernote
        // $('#summernote').summernote()
        // $('#content').summernote(
        //     {
        //         height: 400,
        //         codemirror: { // codemirror options
        //             theme: 'monokai',
        //             mode: "htmlmixed",
        //         }
        //     }
        // );
        // $('#characteristics').summernote(
        //     {
        //         height: 400,
        //         codemirror: { // codemirror options
        //             theme: 'monokai',
        //             mode: "htmlmixed",
        //         }
        //     }
        // );

        // CodeMirror
        // CodeMirror.fromTextArea(document.getElementById("content"), {
        //     mode: "htmlmixed",
        //     theme: "monokai"
        // });
    })
    // BS-Stepper Init
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    })

    $("#dataTable").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false, order: [[1, 'desc']],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

    // $('#dataTable').DataTable({
    //     "paging": true,
    //     "lengthChange": false,
    //     "searching": false,
    //     "ordering": true,
    //     "info": true,
    //     "autoWidth": false,
    //     "responsive": true,
    // });

    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template")
    previewNode.id = ""
    var previewTemplate = previewNode.parentNode.innerHTML
    previewNode.parentNode.removeChild(previewNode)

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/admin/products/images", // Set the url
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        paramName: 'images',
        uploadMultiple: true,
        createImageThumbnails: true,
        ignoreHiddenFiles: true,
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        acceptedFiles: 'image/*',
        // acceptedFiles: ".jpeg,.jpg,.png,.gif",
        hiddenInputContainer: 'form',
        // forceFallback:false,
        autoQueue: true, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
        success: function (file, response) {
            var imgName = response;
            // file.previewElement.classList.add("dz-success");
            document.querySelector("#images").value = imgName;
            console.log("Successfully uploaded :" + imgName);
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    })

    myDropzone.on("addedfile", function (file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function () {
            myDropzone.enqueueFile(file)
        }
    })

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
        console.log(progress);
    })

    myDropzone.on("sending", function (file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0"
        console.log(progress);
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
    }

    // DropzoneJS Demo Code End

    function addProducts(id, text) {
        console.log(text);
        console.log(id);
        document.getElementById('selected').insertAdjacentHTML('beforeend', '<div id="product_field_' + id + '">' +
            '<label for="product">' + text + '</label>' +
            '<div class="input-group">' +
            '<input id="product" name="products[' + id + '][id]" type="text" class="form-control hidden" value="' + id + '">' +
            '<div class="input-group-append">' +
            '<input id="product" name="products[' + id + '][count]" type="number" class="form-control" placeholder="Кількість">' +
            '<button  onclick="removeProduct('+id+')" class="form-control btn-danger" type="button">Delete</button>' +
            '</div>' +
            '</div>' +
            '</div>');
    }
    function removeProduct(id) {
        document.getElementById("product_field_" + id).remove();
    }
</script>
<script src="{{asset('tinymce/js/tinymce/tinymce.min.js')}}"></script>
<script>
    $(function () {

        tinymce.init({
            selector: 'textarea#content',
            height: 600,
            plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            language: 'uk'
        });

        tinymce.init({
            selector: 'textarea#characteristics',
            height: 300,
            plugins: 'print preview powerpaste casechange importcss tinydrive searchreplace autolink autosave save directionality advcode visualblocks visualchars fullscreen image link media mediaembed template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists checklist wordcount tinymcespellchecker a11ychecker imagetools textpattern noneditable help formatpainter permanentpen pageembed charmap tinycomments mentions quickbars linkchecker emoticons advtable export',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen formatpainter removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media pageembed template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            language: 'uk'
        });
    });
</script>

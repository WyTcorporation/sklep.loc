<footer class="main-footer">
    <strong>Copyright &copy; 2011-2022 <a href="http://lockIt.com.ua">LockIt.com.ua</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0.5
    </div>
</footer>


<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('plugins/jquery-ui/jquery-ui.min.js')}}"></script>
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

    var myDropzone = new Dropzone('#actions', {
        url: "/admin/products/images", // Set the url
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        paramName: 'images',
        uploadMultiple: false,
        createImageThumbnails: true,
        ignoreHiddenFiles: true,
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        acceptedFiles: 'image/*',
        hiddenInputContainer: 'form',
        autoQueue: true,
        previewsContainer: "#previews",
        clickable: ".fileinput-button",
        success: function (file, response) {
            var data = response;
            if (typeof response === 'string') {
                try {
                    data = JSON.parse(response);
                } catch (e) {
                    data = {};
                }
            }
            file.previewElement.dataset.path = data.path;
            file.previewElement.dataset.name = data.name;
            refreshImagesField();
        },
        error: function (file, response) {
            file.previewElement.classList.add("dz-error");
        }
    })

    myDropzone.on("addedfile", function (file) {
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
        document.querySelector("#total-progress").style.opacity = "1"
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
    })

    myDropzone.on("queuecomplete", function () {
        document.querySelector("#total-progress").style.opacity = "0"
    })

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions .start").onclick = function () {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
    }
    document.querySelector("#actions .cancel").onclick = function () {
        myDropzone.removeAllFiles(true)
        refreshImagesField()
    }

    function refreshImagesField() {
        var images = [];
        $('#previews .dz-preview').each(function (index) {
            $(this).find('.image-index').text(index + 1);
            images.push({
                name: $(this).data('name'),
                path: $(this).data('path'),
                sort_order: index,
                is_main: $(this).find('.is-main').is(':checked')
            });
        });
        document.querySelector('#image_payload').value = JSON.stringify(images);
    }

    if ($('#previews').data('ui-sortable')) {
        $('#previews').sortable('destroy');
    }
    $('#previews').sortable({
        items: '.dz-preview',
        update: refreshImagesField
    });

    $('#previews').on('change', '.is-main', function () {
        $('#previews .is-main').not(this).prop('checked', false);
        refreshImagesField();
    });

    myDropzone.on('removedfile', function () {
        refreshImagesField();
    });

    $('#previews .dz-preview').each(function (index) {
        $(this).find('.image-index').text(index + 1);
        $(this).find('.is-main').prop('checked', $(this).data('is-main') == 1);
    });
    refreshImagesField();

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
            plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen removeformat | pagebreak | charmap emoticons | fullscreen  preview save | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            language: 'uk'
        });

tinymce.init({
            selector: 'textarea#characteristics',
            height: 300,
            plugins: 'print preview importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist checklist | forecolor backcolor casechange permanentpen removeformat | pagebreak | charmap emoticons | fullscreen  preview save | insertfile image media template link anchor codesample | a11ycheck ltr rtl | showcomments addcomment',
            language: 'uk'
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const fileInput = document.getElementById('product-images');
        const imageList = document.getElementById('image-list');
        const imagesInput = document.getElementById('image_payload');
        if (!fileInput || !imageList || !imagesInput) return;

        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const uploadUrl = '{{ route('products.images.post') }}';
        const productId = {{ isset($item) ? $item->id : 'null' }};

        function updateSortOrderNames() {
            Array.from(imageList.children).forEach((item, index) => {
                const sort = item.querySelector('.sort-order');
                sort.name = `images[${index}][sort_order]`;
            });
        }

        function rebuildSortOrders() {
            Array.from(imageList.children).forEach((item, index) => {
                const sort = item.querySelector('.sort-order');
                sort.name = `images[${index}][sort_order]`;
                sort.value = index;
            });
        }

        function updateImagesField() {
            const data = [];
            Array.from(imageList.children).forEach(item => {
                const name = item.dataset.name;
                const path = item.dataset.path;
                const sort = item.querySelector('.sort-order').value;
                const isMain = item.querySelector('input[type="radio"]').checked;
                data.push({name, path, sort_order: Number(sort), is_main: isMain});
            });
            imagesInput.value = JSON.stringify(data);
        }

        function createImageItem(image) {
            const container = document.createElement('div');
            container.className = 'image-item d-flex align-items-center mb-2';
            container.dataset.name = image.name;
            container.dataset.path = image.path || '';

            const img = document.createElement('img');
            img.src = image.preview || image.path;
            img.width = 80;
            img.height = 80;
            img.className = 'mr-2';

            const sort = document.createElement('input');
            sort.type = 'number';
            sort.className = 'form-control sort-order mr-2';
            sort.name = 'images[0][sort_order]';
            sort.value = image.sort_order != null ? image.sort_order : 0;

            const radio = document.createElement('input');
            radio.type = 'radio';
            radio.name = 'main_image';
            radio.className = 'mr-2';
            radio.checked = Boolean(image.is_main);

            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'btn btn-danger btn-sm delete-image';
            btn.textContent = 'Delete';

            container.appendChild(img);
            container.appendChild(sort);
            container.appendChild(radio);
            container.appendChild(btn);

            imageList.appendChild(container);
        }

        function addFromFile(file) {
            const reader = new FileReader();
            reader.onload = e => {
                const formData = new FormData();
                formData.append('images', file);
                formData.append('_token', csrf);
                if (productId) formData.append('product_id', productId);

                fetch(uploadUrl, {method: 'POST', body: formData})
                    .then(res => res.json())
                    .then(data => {
                        createImageItem({
                            name: data.name || file.name,
                            path: data.path || '',
                            preview: e.target.result
                        });
                        rebuildSortOrders();
                        updateImagesField();
                    });
            };
            reader.readAsDataURL(file);
        }

        fileInput.addEventListener('change', e => {
            Array.from(e.target.files).forEach(addFromFile);
            e.target.value = '';
        });

        imageList.addEventListener('click', e => {
            if (e.target.classList.contains('delete-image')) {
                e.target.closest('.image-item').remove();
                rebuildSortOrders();
                updateImagesField();
            }
        });

        imageList.addEventListener('change', e => {
            if (e.target.classList.contains('sort-order') || e.target.name === 'main_image') {
                updateSortOrderNames();
                updateImagesField();
            }
        });

        $(imageList).sortable({
            update: function () {
                rebuildSortOrders();
                updateImagesField();
            }
        });

        const existing = imagesInput.value ? JSON.parse(imagesInput.value) : [];
        existing.forEach(img => createImageItem(img));
        updateSortOrderNames();
        updateImagesField();
    });
</script>

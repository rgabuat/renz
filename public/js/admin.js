$(document).ready(function() {

    // $('#domain_tbl').DataTable({
    //   "paging": true,
    //   "lengthChange": false,
    //   "searching": true,
    //   "ordering": true,
    //   "info": true,
    //   "autoWidth": false,
    //   "responsive": true,
    // });


    // company table
    $('#company_tbl_search').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });



    $('#tbl_users,#sub_accounts_tbl,#company_tbl,#subs_table,#invoices_tbl,#packages_tbl').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
  });


    dataTable = $("#article_tbl,#article_ords_tbl").DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "columnDefs": [
            {
                "targets": '_all',
                "visible": true
            }
        ]
    });
    $('.status-dropdown').on('change', function(e){
        var status = $(this).val();
        $('.status-dropdown').val(status)
        dataTable.column(8).search(status).draw();
    });

    $('.ord_status-dropdown').on('change', function(e){
        var status = $(this).val();
        $('.status-dropdown').val(status)
        dataTable.column(8).search(status).draw();
    });

    // tiny mce plugin
    tinymce.init({
        selector: 'textarea',
        convert_urls: false,
        statusbar: false, 
        height: 600,
        plugins: 'image code print preview fullpage  searchreplace autolink directionality  visualblocks visualchars fullscreen image link    table charmap hr pagebreak nonbreaking  toc insertdatetime advlist lists textcolor wordcount   imagetools    contextmenu colorpicker textpattern media ',
        toolbar: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat |undo redo | image code| link fontsizeselect  | ',
        image_title: true,
        automatic_uploads: true,
        images_upload_url: '/article/upload',
        file_picker_types: 'image',
        file_picker_callback: function(cb, value, meta) {

            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.onchange = function() {
                var file = this.files[0];

                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                };
            };
            input.click();
        }
    });

  
  });

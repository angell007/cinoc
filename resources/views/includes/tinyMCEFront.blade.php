<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('admin_assets/global/plugins/tinymce/js/tinymce/tinymce.min.js') }}"></script>
<script>
tinymce.init({
    selector: '#description',
    setup: function(editor) {
        var text
    editor.on('keyup', function(e) {
     var words= e.target.innerHTML.split(" ").length+ e.target.innerHTML.split("<br>").length-1
     if(words>=250){
        e.target.innerHTML=text
         editor.selection.select(editor.getBody(), true); // ed is the editor instance
editor.selection.collapse(false);
     }else{ 
         text=e.target.innerHTML
     }
     
    });
    },
    height: 150,
    forced_root_block: '',
    plugins: [
        'advlist autolink lists image',
        'searchreplace visualblocks code fullscreen',
        'media table contextmenu paste code'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',
    relative_urls: true,
    images_upload_url: "{{ route('tinymce.image_upload.front') }}",
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");
        xhr.onload = function () {
            var json;
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.location);
        };
        formData = new FormData();
        formData.append('image', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
    },
});
	
	tinymce.init({
    selector: '#benefits',
    height: 150,
    forced_root_block: '',
    plugins: [
        'advlist autolink lists image',
        'searchreplace visualblocks code fullscreen',
        'media table contextmenu paste code'
    ],
    toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image',
    relative_urls: true,
    images_upload_url: "{{ route('tinymce.image_upload.front') }}",
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', "{{ route('tinymce.image_upload.front') }}");
        xhr.onload = function () {
            var json;
            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }
            json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }
            success(json.location);
        };
        formData = new FormData();
        formData.append('image', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
    },
});
</script>
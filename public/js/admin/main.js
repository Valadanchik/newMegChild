var options = [];

document.querySelectorAll('.dropdown-menu a').forEach(function(item) {
    item.addEventListener('click', function(event) {
        var target = event.currentTarget,
            val = target.getAttribute('data-value'),
            inp = target.querySelector('input'),
            idx;

        if ((idx = options.indexOf(val)) > -1) {
            options.splice(idx, 1);
            setTimeout(function() {
                inp.checked = false;
            }, 0);
        } else {
            options.push(val);
            setTimeout(function() {
                inp.checked = true;
            }, 0);
        }

        event.target.blur();

        console.log(options);
        return false;
    });
});


$("#bookFiles").fileinput({
    showRemove: true,
    showCancel: true,
    browseLabel: "<i class='fa fa-folder-open'></i>",
    initialPreviewAsData: true,
    fileActionSettings :{
        showUpload: false,
        showZoom: false,
        removeIcon: "<i class='fa fa-times'></i>",
    },
    allowedFileExtensions: ['jpg', 'png', 'gif'],
    maxFileSize:2000,
    maxFilesNum: 10,
});

$(document).ready(function() {
    $('.summernote').summernote({
        tabsize: 2,
        height: 320,
    });

    var allids = [];
    $('.remove-image').click(function() {
        allids.push($(this).attr('data-img-id'));
        $("input[name=deleted_images_id]").val(allids.join(','));
        $(this).parent().remove();
    });
});



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


$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let imageUrl = $('.book-edit-images').val()
    let bookOrderingRoute = $('.book-ordering-route').val()
    let bookDestroyRrouting = $('.book-destroy-routing').val()
    let images = []
    let updateUrl = ''
    let deleteUrl = ''

    if (bookOrderingRoute !== undefined) updateUrl = bookOrderingRoute

    if (bookDestroyRrouting !== undefined) deleteUrl = bookDestroyRrouting

    if (imageUrl !== undefined) images = JSON.parse(imageUrl)

    $("#bookFiles, #accessorsFiles").fileinput({
        initialPreviewAsData: true,
        initialPreview: images.map(image => image.image_url),
        initialPreviewConfig: images.map(image => {
            return {
                key: image.id,
                extra: { id: image.id },
                url: deleteUrl + '/' + image.id,
                keyExtra: { id: image.id },
                width: "120px",
                height: "80px",
            };
        }),
        autoOrientImage: true,
        overwriteInitial: true,
        maxFileSize: 100,
        initialCaption: "The Moon and the Earth",
        showUpload: false,
        showRemove: true,
        fileActionSettings: {
            removeIcon: "<i class='bi-trash'></i>",
        }

    }).on('filesorted', function(event, params) {
        saveImageOrder(params.stack);
    });

    /**
     *
     * @param sortedImageIds
     */
    function saveImageOrder(sortedImageIds) {
        $.ajax({
            url: updateUrl,
            method: "PUT",
            data: { order: sortedImageIds },
            success: function(response) {
                console.log(response);
            },
        });
    }

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

    $('#all_books').click(function () {
        $('.book_id').prop('checked', false);
    })

    $('.book_id').click(function () {
        if($(this).is(':checked')){
            $('#all_books').prop('checked', false);
        }
    })
});



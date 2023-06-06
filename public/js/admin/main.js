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
    $('.summernote').summernote({
        tabsize: 2,
        height: 320,
    });
});



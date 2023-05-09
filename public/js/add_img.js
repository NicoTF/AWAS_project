$(document).ready(function () {
    $('#add_img').click(function () {
        var url = $('input[name="url"]').val();
        $.ajax('/add_image.php', {
            method: 'GET',
            data: {
                url: url
            },
        }).done(function (data) {
            // refresh page and empty input
            $('input[name="url"]').val('');
            location.reload();
        });
    });
});
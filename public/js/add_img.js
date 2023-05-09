$(document).ready(function () {
    $('#add_img').click(function () {
        var url = $('input[name="url"]').val();
        $.ajax('/add_image.php', {
            method: 'GET',
            data: {
                url: url
            },
        }).done(function (data) {
            if (data === '') {
                $('input[name="url"]').val('');
                location.reload();
            }
        });
    });
});
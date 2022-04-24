$.ajaxSetup(
{
    headers:
    {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function () {
    $('#updateAvatarForm').on('submit', function (e) {
        if (!$('#avatar_image').val()) {
            e.preventDefault();
            Swal.fire({
                title: 'Please Upload Avatar',
                icon: 'warning',
                button: 'OK',
            });
        }
    });
});

$(function () {
    // Update Admin Personal Info
    $('#adminInfoForm').on('submit', function (e) {
        e.preventDefault();

        $.ajax(
            {
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: new FormData(this),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function () {
                    $(document).find('span.error-text').text('');
                },
                success: function (data) {
                    if (data.status == 0) {
                        $.each(data.error, function (prefix, val) {
                            $('span.' + prefix + '_error').text(val[0]);
                        });
                    }
                    else {
                        $('.admin_name').each(function () {
                            $(this).html($('#adminInfoForm').find($('input[name="name"]')).val());
                        });
                        Swal.fire({
                            title: data.msg,
                            icon: 'success',
                            button: 'OK',
                        });
                    }
                }
            });
    });

    $('#changePasswordForm').on('submit', function (e)
    {
        e.preventDefault();
        $.ajax(
        {
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function ()
            {
                $(document).find('span.error-text').text('');
            },
            success: function (data)
            {
                if (data.status == 0)
                {
                    $.each(data.error, function (prefix, val) {
                        $('span.' + prefix + '_error').text(val[0]);
                    });
                }
                else
                {
                    $('#changePasswordForm')[0].reset();
                    Swal.fire({
                        title: data.msg,
                        icon: 'success',
                        button: 'OK',
                    });
                }
            }
        });
    });
});

function showPassword($passwordId)
{
    var x = document.getElementById($passwordId);
    if (x.type === "password")
    {
        x.type = "text";
    }
    else
    {
        x.type = "password";
    }
}

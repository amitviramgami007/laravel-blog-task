$(function ()
{
    $.ajaxSetup(
    {
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.data-table').DataTable(
    {
        ajax: listRoute,
        columns:
        [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'created_by', name: 'created_by'},
            {data: 'updated_by', name: 'updated_by'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('.data-table').on('click', '.email-send', function(e)
    {
        let email = $(this).data("email");
        e.preventDefault();

        $.ajax(
        {
            type: "POST",
            url: "/send-welcome-email/",
            data: { "email" : email, "_token": _token},
            success: function (data)
            {
                Swal.fire({
                    title: data.success,
                    icon: 'success',
                    button : 'OK',
                });
            },
            error: function (data)
            {
                console.log('Error:', data);
            }
        });
    });
});

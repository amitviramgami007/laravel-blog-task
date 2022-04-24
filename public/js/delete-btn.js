$('.data-table').on('click', '.delete-action', function(e)
{
    var form =  $(this).siblings("form");
    e.preventDefault();

    Swal.fire(
    {
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        showConfirmButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    })
    .then((result) =>
    {
        if (result.isConfirmed)
        {
            form.submit();
        }
    });
});

$(document).on('click', '.pagination a', function (e) {
    e.preventDefault();

    let url = $(this).attr('href'); // Get the URL from the pagination link

    $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function () {
            // Optional: Add a loading spinner
            $('#course-container').html('<p>Loading...</p>');
        },
        success: function (data) {
            // Replace the course container with new content
            $('#course-container').html(data);
        },
        error: function () {
            alert('Something went wrong. Please try again.');
        }
    });
});

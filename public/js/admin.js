function slide() {
    const navbar = document.querySelector('#navbar');
    const overlay = document.querySelector('.overlay');

    navbar.classList.toggle('show-navbar');
    overlay.classList.toggle('show-overlay');
}

// Using bootbox modal
$(document).ready(function() {
    $('.modal .btn-delete').click(function () {
        let form = $('#delete-form');
        //console.log(form);
        form.submit();
        //alert('You clicked Delete');
    });
});

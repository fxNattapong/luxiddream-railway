$(document).ready(function() {
    $('#btn-menu-switch').on('click', function() {
        $('#sidebar').toggleClass('max-md:min-w-0 max-md:max-w-[60px]');
        $('#btn-menu-switch').toggleClass('rotate-180');
        $('#img-logo').toggleClass('max-md:h-full');
        $('#text-logo').toggleClass('max-md:hidden');
    });

    // SWEETALERT LOGOUT
    $('#btn-logout').on('click', function () {
        Swal.fire({
            title: `คุณต้องการออกจากระบบใช่หรือไม่`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่, ตกลง',
            cancelButtonText: 'ยกเลิก',
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $('#btn-logout').data('route');
            }
        })
    });
});

function openMenuMembers() {
    $('#menu-members').toggleClass("hidden");
    $('#btnMenuMembers').toggleClass("bg-[#E4E9F7]");
    $('#btnMenuMembers').toggleClass("text-gray-700 text-blue-700");
    $('#icon-arrow').toggleClass("rotate-180");

    $('#sidebar').toggleClass('max-md:min-w-0 max-md:max-w-[60px]');
    $('#btn-menu-switch').toggleClass('rotate-180');
}

// BUTTON LOGGED SORT
function openMenuLogged() {
    var btnLogged = $('#btnLoggedMenu .flex');
    var popup = $('#menu-logged');
    var icon = $('#icon-settings');

    if (btnLogged.hasClass('text-gray-700')) {
        btnLogged.removeClass('text-gray-700').addClass('text-indigo-600');
        popup.removeClass('hidden');
        popup.addClass('h-full');
        icon.addClass('rotate-180');
    } else {
        btnLogged.removeClass('text-indigo-600').addClass('text-gray-700');
        popup.addClass('hidden');
        popup.removeClass('h-full');
        icon.removeClass('rotate-180');
    }
}
$(document).mouseup(function(e) {
    var btnLogged = $('#btnLoggedMenu .flex');
    var popup = $('#menu-logged');
    var icon = $('#icon-settings');

    if (!btnLogged.is(e.target) && btnLogged.has(e.target).length === 0 &&
        !popup.is(e.target) && popup.has(e.target).length === 0) {
        btnLogged.removeClass('text-blue-700').addClass('text-gray-700');
        popup.addClass('hidden');
        icon.removeClass('rotate-180');
    }
});
document.getElementById('menu-icon').onclick = function() {
    var sidenav = document.getElementById('mySidenav');
    if (sidenav.style.width === '250px') {
        sidenav.style.width = '0';
        document.querySelector('main').style.marginLeft = '0';
    } else {
        sidenav.style.width = '250px';
        document.querySelector('main').style.marginLeft = '260px';
    }
    sidenav.classList.toggle('p-4');
}

// Close the sidebar if the user clicks outside of it
window.onclick = function(event) {
    var sidenav = document.getElementById('mySidenav');
    if (event.target == sidenav) {
        sidenav.style.width = "0";
        document.querySelector('main').style.marginLeft = '0';
    }
}


$(document).ready(function() {
    var sidebar = $('#mySidenav');
    sidebar.style.width = '0';
    $('main').style.marginLeft = '0';
});
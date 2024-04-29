document.getElementById('menu-icon').onclick = function() {
    var sidenav = document.getElementById('mySidenav');
    if (sidenav.style.width === '250px') {
        sidenav.style.width = '0';
        document.querySelector('main').style.marginLeft = '0';
    } else {
        sidenav.style.width = '250px';
        document.querySelector('main').style.marginLeft = '260px';
    }
}

// Close the sidebar if the user clicks outside of it
window.onclick = function(event) {
    var sidenav = document.getElementById('mySidenav');
    if (event.target == sidenav) {
        sidenav.style.width = "0";
        document.querySelector('main').style.marginLeft = '0';
    }
}

// File: wp-content/themes/your-theme/js/sticky-navbar.js

document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.getElementById('navbar');

    if (!navbar) {
        console.error('Navbar element not found!');
        return;
    }

    var body = document.body;
    var stickyOffset = navbar.offsetTop;

    // Check if the body has the logged-in class and adjust the stickyOffset
    if (body.classList.contains('logged-in')) {
        stickyOffset -= 32; // Adjust offset to account for admin bar height
    }

    window.addEventListener('scroll', function() {
        if (window.scrollY > stickyOffset) {
            navbar.classList.add('is-sticky');
        } else {
            navbar.classList.remove('is-sticky');
        }
    });
});
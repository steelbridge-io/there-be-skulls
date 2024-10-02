// File: wp-content/themes/your-theme/js/sticky-navbar.js

document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar-header');
    const overlay = document.querySelector('.overlay');
    let logoTransitioned = false;

    // Helper functions to manage cookies
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/`;
    }

    function getCookie(name) {
        const cname = `${name}=`;
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        for (let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i].trim();
            if (cookie.indexOf(cname) === 0) {
                return cookie.substring(cname.length, cookie.length);
            }
        }
        return '';
    }

    if (!navbar) {
        console.error('Navbar element not found!');
        return;
    }

    if (!overlay) {
        console.error('Overlay element not found!');
        return;
    }

    // Only run on the home page
    const isHomePage = document.body.classList.contains('home');
    if (!isHomePage) {
        overlay.style.display = 'none'; // Hide overlay on non-home/front-page
        return;
    }

    // Use cookies to track if the animation has already occurred
    const animationCookieName = 'animationOccurred';
    const animationOccurred = getCookie(animationCookieName);
    if (animationOccurred) {
        overlay.style.display = 'none'; // Hide overlay if animation has already occurred
        console.log("Animation cookie found. Applying 'small' class without transition.");

        // Temporarily disable transitions
        navbar.classList.add('no-transition');
        navbar.classList.add('small');
        navbar.offsetHeight; // Trigger reflow for the class to take effect
        navbar.classList.remove('no-transition');

        logoTransitioned = true; // Mark the logo as transitioned
        return;
    } else {
        console.log("No animation cookie found, running animation...");
    }

    const body = document.body;
    let stickyOffset = navbar.offsetTop;

    // Check if the body has the logged-in class and adjust the stickyOffset
    if (body.classList.contains('logged-in')) {
        stickyOffset -= 32; // Adjust offset to account for the admin bar height
    }

    // Listen for the end of the transition on the overlay
    overlay.addEventListener('transitionend', function () {
        if (overlay.classList.contains('fade-out')) {
            overlay.style.zIndex = '-1';
            overlay.classList.add('fade-out-complete');
            console.log('Overlay transition ended, z-index set to -1');
        }
    });

    window.addEventListener('scroll', function () {
        if (!logoTransitioned && window.scrollY > 50) {
            // Handle logo transition and overlay fade-out only once the scroll hits the threshold
            console.log("Scroll threshold reached. Applying 'small' class and fading out overlay.");
            navbar.classList.add('small');
            overlay.classList.add('fade-out'); // Add class to fade out the overlay
            logoTransitioned = true; // Prevent further transitions

            // Mark the animation as occurred in cookies (expires in 1 day)
            setCookie(animationCookieName, 'true', 1);
        }

        // Handle sticky navbar
        if (window.scrollY > stickyOffset) {
            navbar.classList.add('is-sticky');
        } else {
            navbar.classList.remove('is-sticky');
        }
    });
});








/*document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar-header');
    const overlay = document.querySelector('.overlay');
    let logoTransitioned = false;

    // Helper functions to manage cookies
    function setCookie(name, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        const expires = `expires=${date.toUTCString()}`;
        document.cookie = `${name}=${value};${expires};path=/`;
    }

    function getCookie(name) {
        const cname = `${name}=`;
        const decodedCookie = decodeURIComponent(document.cookie);
        const cookieArray = decodedCookie.split(';');
        for (let i = 0; i < cookieArray.length; i++) {
            let cookie = cookieArray[i].trim();
            if (cookie.indexOf(cname) === 0) {
                return cookie.substring(cname.length, cookie.length);
            }
        }
        return '';
    }

    if (!navbar) {
        console.error('Navbar element not found!');
        return;
    }

    if (!overlay) {
        console.error('Overlay element not found!');
        return;
    }

    // Only run on the front-page.php
    const isFrontPage = document.body.classList.contains('home');
    if (!isFrontPage) {
        overlay.style.display = 'none'; // Hide overlay on non-front-page
        return;
    }

    // Use cookies to track if the animation has already occurred
    const animationCookieName = 'animationOccurred';
    const animationOccurred = getCookie(animationCookieName);
    if (animationOccurred) {
        overlay.style.display = 'none'; // Hide overlay if animation has already occurred
        return;
    } else {
        console.log("No animation cookie found, running animation...");
    }

    const body = document.body;
    let stickyOffset = navbar.offsetTop;

    // Check if the body has the logged-in class and adjust the stickyOffset
    if (body.classList.contains('logged-in')) {
        stickyOffset -= 32; // Adjust offset to account for the admin bar height
    }

    window.addEventListener('scroll', function () {
        // Handle sticky navbar
        if (window.scrollY > stickyOffset) {
            navbar.classList.add('is-sticky');
        } else {
            navbar.classList.remove('is-sticky');
        }

        // Handle logo transition and overlay fade-out only if it hasn't transitioned yet
        if (window.scrollY > 50 && !logoTransitioned) {
            navbar.classList.add('small');
            overlay.classList.add('fade-out'); // Add class to fade out the overlay
            logoTransitioned = true; // Set flag to true to prevent further transitions

            // Mark the animation as occurred in cookies (expires in 1 day)
            setCookie(animationCookieName, 'true', 1);
        }
    });
}); */


















/*document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar-header');
    let logoTransitioned = false; // Flag to track if the transition has occurred
    const overlay = document.querySelector('.overlay'); // Select the overlay element

    if (!navbar) {
        console.error('Navbar element not found!');
        return;
    }

    if (!overlay) {
        console.error('Overlay element not found!');
        return;
    }

    const body = document.body;
    let stickyOffset = navbar.offsetTop;

    // Check if the body has the logged-in class and adjust the stickyOffset
    if (body.classList.contains('logged-in')) {
        stickyOffset -= 32; // Adjust offset to account for the admin bar height
    }

    window.addEventListener('scroll', function () {
        // Handle sticky navbar
        if (window.scrollY > stickyOffset) {
            navbar.classList.add('is-sticky');
        } else {
            navbar.classList.remove('is-sticky');
        }

        // Handle logo transition and overlay fade-out only if it hasn't transitioned yet
        if (window.scrollY > 50 && !logoTransitioned) { // Adjust 50 as needed
            navbar.classList.add('small');
            overlay.classList.add('fade-out'); // Add class to fade out the overlay
            logoTransitioned = true; // Set flag to true to prevent further transitions
        }
    });
}); */
/*document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar');
    let logoTransitioned = false; // Flag to track if the transition has occurred

    if (!navbar) {
        console.error('Navbar element not found!');
        return;
    }

    const body = document.body;
    let stickyOffset = navbar.offsetTop;

    // Check if the body has the logged-in class and adjust the stickyOffset
    if (body.classList.contains('logged-in')) {
        stickyOffset -= 32; // Adjust offset to account for the admin bar height
    }

    window.addEventListener('scroll', function () {
        // Handle sticky navbar
        if (window.scrollY > stickyOffset) {
            navbar.classList.add('is-sticky');
        } else {
            navbar.classList.remove('is-sticky');
        }

        // Handle logo transition only if it hasn't transitioned yet
        if (window.scrollY > 50 && !logoTransitioned) { // Adjust 50 as needed
            navbar.classList.add('small');
            logoTransitioned = true; // Set flag to true to prevent further transitions
        }
    });
});*/



/*document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar');

    if (!navbar) {
        console.error('Navbar element not found!');
        return;
    }

    const body = document.body;
    let stickyOffset = navbar.offsetTop;

    // Check if the body has the logged-in class and adjust the stickyOffset
    if (body.classList.contains('logged-in')) {
        stickyOffset -= 32; // Adjust offset to account for the admin bar height
    }

    window.addEventListener('scroll', function () {
        // Handle sticky navbar
        if (window.scrollY > stickyOffset) {
            navbar.classList.add('is-sticky');
        } else {
            navbar.classList.remove('is-sticky');
        }

        // Handle logo transition
        if (window.scrollY > 50 && !navbar.classList.contains('small')) { // Adjust 50 as needed
            navbar.classList.add('small');
        } else if (window.scrollY <= 50 && navbar.classList.contains('small')) {
            navbar.classList.remove('small');
        }
    });
}); */


/*document.addEventListener('DOMContentLoaded', function() {

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
}); */

/*document.addEventListener('DOMContentLoaded', function () {
    const navbarLogo = document.getElementById('navbar');

    window.addEventListener('scroll', function () {
        if (window.scrollY > 50 && !navbarLogo.classList.contains('small')) { // Adjust 50 as needed
            navbarLogo.classList.add('small');
        } else if (window.scrollY <= 50 && navbarLogo.classList.contains('small')) {
            navbarLogo.classList.remove('small');
        }
    });
});*/
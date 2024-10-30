/** Navigation */

document.addEventListener('DOMContentLoaded', function () {
    var dropdowns = document.querySelectorAll('li.dropdown');
    dropdowns.forEach(function (dropdown) {
        dropdown.addEventListener('mouseenter', function () {
            var dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.add('show');
            }
        });
        dropdown.addEventListener('mouseleave', function () {
            var dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
            }
        });
    });

    var submenus = document.querySelectorAll('li.dropdown-submenu');
    submenus.forEach(function (submenu) {
        submenu.addEventListener('mouseenter', function () {
            var dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.add('show');
            }
        });
        submenu.addEventListener('mouseleave', function () {
            var dropdownMenu = this.querySelector('.dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.classList.remove('show');
            }
        });
    });

    // Ensure links remain clickable
    var links = document.querySelectorAll('.nav-link, .dropdown-item');
    links.forEach(function (link) {
        link.addEventListener('click', function (event) {
            if (this.nextElementSibling && this.nextElementSibling.classList.contains('dropdown-menu')) {
                event.preventDefault();
                event.stopPropagation(); // Prevent default behavior and propagation

                // Manually navigate to the link if it is clicked
                window.location.href = this.getAttribute('href');
            }
        });
    });
});

/** /navigation */


document.addEventListener('DOMContentLoaded', function () {
    const navbar = document.getElementById('navbar-header');
    const overlay = document.querySelector('.overlay');
    const title = document.getElementById('title-front-page');
    const intro = document.getElementById('intro-title');
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

    if (!title) {
        console.error('Title element not found!');
        return;
    }

    if (!intro) {
        console.error('Intro element not found!');
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
        title.classList.add('fade-in');
        intro.classList.add('fade-in');
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

            setTimeout(() => {
                title.classList.add('fade-in');
                intro.classList.add('fade-in');
            }, 500); // Adjust the delay as needed (500 ms in this case)

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

document.addEventListener('DOMContentLoaded', function () {
    var navbarCollapse = document.querySelector('#main-menu');
    var navbarToggler = document.querySelector('.navbar-toggler');

    // Hide the menu on navbar item click
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function (el) {
        el.addEventListener('click', function () {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
    var closeMenuButton = document.querySelector('.close-menu');
    var navbarCollapse = document.querySelector('#main-menu');
    var navbarToggler = document.querySelector('.navbar-toggler');

    // Close the menu on close button click
    closeMenuButton.addEventListener('click', function () {
        if (navbarCollapse.classList.contains('show')) {
            navbarToggler.click();
        }
    });

    // Existing code to hide the menu on navbar item click
    document.querySelectorAll('.navbar-nav .nav-link').forEach(function (el) {
        el.addEventListener('click', function () {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });
});


jQuery(document).ready(function ($) {
    function updateCartCount() {
        // Gets the text from cart fragments update
        var count = $('.cart-contents .cart-count').text();
        // Applies it to our .cart-count
        $('.cart-count').text(count);
    }

    // Binds to WooCommerce add or remove from cart events
    $(document.body).on('added_to_cart removed_from_cart', function () {
        updateCartCount();
    });

    // Initial update of the cart count
    updateCartCount();
});
/*** Front Page Animation **/
document.addEventListener('DOMContentLoaded', function () {
    let animatedGraphic = document.getElementById('animated-graphic');
    let animated = false;
    let timer;

    window.addEventListener('scroll', function () {
        if (window.scrollY >= 400 && !animated) {
            // Trigger slide-in animation after scrolling 400px
            animatedGraphic.classList.add('slide-in');
            animated = true;

            // Slide back out after 7 seconds
            timer = setTimeout(function () {
                animatedGraphic.classList.replace('slide-in', 'slide-out');
                // Remove the event listener after the animation completes
                window.removeEventListener('scroll', arguments.callee);
            }, 7000); // 7 seconds delay
        }
    });
});
/*** /Front Page Animation **/

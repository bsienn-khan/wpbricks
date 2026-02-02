/**
 * As we want the navigation to start where the header ends,
 * we need to calculate the header height, rather header bottom boundary and update the mobile nav top position.
 */
function updateMobileNavHeight() {
    const header = document.querySelector('#brx-header');
    if (header) {
        const rect = header.getBoundingClientRect();
        document.querySelector('.bricks-mobile-menu-wrapper').style.setProperty('top', rect.bottom + 'px');
    }
}

// Initial calculation and updates on window changes
window.addEventListener('load', updateMobileNavHeight);
window.addEventListener('resize', updateMobileNavHeight);

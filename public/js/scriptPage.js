const banner = document.querySelector('.banner');
const retour = document.querySelector('.return');


banner.addEventListener('mouseenter', (mouseBanner));
retour.addEventListener('mouseenter', (mouseBanner));

function mouseBanner() {
    banner.style.filter = 'opacity(100%)';
}

banner.addEventListener('mouseleave', (mouseBannerOut));

function mouseBannerOut() {
    banner.style.filter = 'opacity(65%)';
}














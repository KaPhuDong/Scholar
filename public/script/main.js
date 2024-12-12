let currentIndex = 0;

function moveSlide() {
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;

    currentIndex++;

    if (currentIndex >= totalSlides - 1) {
        slides.style.transition = 'none';
        slides.style.transform = 'translateX(0)';
        currentIndex = 0;

        setTimeout(() => {
            slides.style.transition = 'transform 1.5s ease';
            moveSlide();
        }, 50);
    } else {
        const offset = -currentIndex * 100;
        slides.style.transform = `translateX(${offset}%)`;
    }
}
setInterval(() => {
    moveSlide();
}, 2000);
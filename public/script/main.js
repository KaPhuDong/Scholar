let currentIndex = 0;

// Slider 1
function moveSlide1() {
    const slides = document.querySelector('.slides');
    const totalSlides = document.querySelectorAll('.slide').length;

    currentIndex++;

    if (currentIndex >= totalSlides - 1) {
        slides.style.transition = 'none';
        slides.style.transform = 'translateX(0)';
        currentIndex = 0;

        setTimeout(() => {
            slides.style.transition = 'transform 1.5s ease';
            moveSlide1();
        }, 50);
    } else {
        const offset = -currentIndex * 100;
        slides.style.transform = `translateX(${offset}%)`;
    }
}
setInterval(() => {
    moveSlide1();
}, 2000);

// Slider 2
function moveSlide2() {
    const sliders = document.querySelectorAll('.note-slider .slides');
    sliders.forEach(slides => {
        const totalSlides = slides.querySelectorAll('.slide').length;
        currentIndex++;

        if (currentIndex >= totalSlides - 1) {
            slides.style.transition = 'none';
            slides.style.transform = 'translateX(0)';
            currentIndex = 0;

            setTimeout(() => {
                slides.style.transition = 'transform 2s ease';
                moveSlide2();
            }, 50);
        } else {
            const offset = -currentIndex * 100;
            slides.style.transform = `translateX(${offset}%)`;
        }
    });
}
setInterval(() => {
    moveSlide2();
}, 2000);
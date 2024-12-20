// Dùng querySelectorAll để lấy tất cả slider
const sliders = document.querySelectorAll('.slides');

sliders.forEach((slider, index) => {
    let currentIndex = 0;
    const slides = slider.children; // Lấy các slide bên trong slider hiện tại
    const totalSlides = slides.length;

    function moveSlide() {
        currentIndex++;
        
        if (currentIndex >= totalSlides) {
            slider.style.transition = 'none';
            slider.style.transform = 'translateX(0)';
            currentIndex = 0;

            setTimeout(() => {
                slider.style.transition = 'transform 1.5s ease';
                moveSlide();
            }, 50);
        } else {
            const offset = -currentIndex * 100;
            slider.style.transform = `translateX(${offset}%)`;
        }
    }

    // Tự động chạy slider
    setInterval(() => {
        moveSlide();
    }, 2000);
});

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
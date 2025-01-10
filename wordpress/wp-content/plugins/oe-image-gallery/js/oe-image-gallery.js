document.addEventListener('DOMContentLoaded', function () {
    const slides = document.querySelectorAll('.oe-slide');
    const prevButton = document.querySelector('.oe-prev');
    const nextButton = document.querySelector('.oe-next');
    const indicators = document.querySelectorAll('.oe-indicator');
    const images = document.querySelectorAll('.oe-slide img');  // Select the images
    let currentSlide = 0;

    function showSlide(index) {
        const slideshow = document.querySelector('.oe-slideshow');
        const totalSlides = slides.length;

        // Wrap around if index is out of bounds
        if (index < 0) {
            currentSlide = totalSlides - 1;
        } else if (index >= totalSlides) {
            currentSlide = 0;
        } else {
            currentSlide = index;
        }

        const offset = -currentSlide * 100; // Move the slideshow
        slideshow.style.transform = `translateX(${offset}%)`;

        // Update indicators
        updateIndicators(currentSlide);
    }

    function updateIndicators(index) {
        indicators.forEach((indicator, i) => {
            indicator.classList.toggle('active', i === index);
        });
    }

    // Event Listeners for buttons
    prevButton.addEventListener('click', function () {
        showSlide(currentSlide - 1);
    });

    nextButton.addEventListener('click', function () {
        showSlide(currentSlide + 1);
    });

    // Event Listeners for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function () {
            showSlide(index);
        });
    });

    // Add click event to images for the lightbox
    images.forEach((image) => {
        image.addEventListener('click', function () {
            const imageUrl = image.src;  // Get the clicked image URL
            openLightbox(imageUrl);  // Function to open the lightbox
        });
    });

    // Initialize with the first slide
    showSlide(currentSlide);

    // Lightbox function to open the image
    function openLightbox(imageUrl) {
        const lightbox = document.createElement('div');
        lightbox.classList.add('lightbox');
        lightbox.innerHTML = `<div class="lightbox-content">
            <img src="${imageUrl}" alt="Enlarged image">
            <span class="lightbox-close">&times;</span>
        </div>`;

        document.body.appendChild(lightbox);

        // Close lightbox when clicking the close button or outside the image
        lightbox.querySelector('.lightbox-close').addEventListener('click', () => {
            document.body.removeChild(lightbox);
        });

        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox) {
                document.body.removeChild(lightbox);
            }
        });
    }
});
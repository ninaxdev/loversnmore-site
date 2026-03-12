<div class="lw-icebreaker-carousel-container">
    <!-- Carousel Wrapper -->
    <div class="lw-icebreaker-carousel overflow-hidden relative w-full">
        <div class="lw-icebreaker-slides flex transition-transform duration-500 ease-in-out" id="lwIcebreakerSlides">
            <!-- Cards will be dynamically inserted here -->
        </div>
    </div>

    <!-- Pagination Dots -->
    <div class="flex justify-center gap-2 mt-6" id="lwIcebreakerPagination">
        <!-- Dots will be dynamically inserted here -->
    </div>
</div>

<style>
.lw-icebreaker-card-item {
    min-width: 200px;
    max-width: 200px;
    margin: 0 6px;
    padding: 18px 14px;
    border-radius: 18px;
    text-align: center;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 320px;
}

.lw-icebreaker-card-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(91, 62, 150, 0.2);
}

.lw-icebreaker-card-bg-1 {
    background: linear-gradient(135deg, #E9D8FD 0%, #D6BCFA 100%);
}

.lw-icebreaker-card-bg-2 {
    background: linear-gradient(135deg, #FED7E2 0%, #FBB6CE 100%);
}

.lw-icebreaker-card-bg-3 {
    background: linear-gradient(135deg, #FEEBC8 0%, #FBD38D 100%);
}

.lw-icebreaker-statement {
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    font-weight: 500;
    color: #4A5568;
    line-height: 1.4;
    margin-bottom: 10px;
}

.lw-icebreaker-divider {
    width: 40px;
    height: 1px;
    background-color: rgba(74, 85, 104, 0.2);
    margin: 10px auto;
}

.lw-icebreaker-question {
    font-family: 'Poppins', sans-serif;
    font-size: 15px;
    font-weight: 600;
    color: #2D3748;
    line-height: 1.3;
    margin-bottom: auto;
    padding: 10px 0;
}

.lw-icebreaker-select-btn {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    font-weight: 600;
    color: white;
    background: linear-gradient(135deg, #805AD5 0%, #6B46C1 100%);
    border: none;
    border-radius: 12px;
    padding: 9px 24px;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 10px;
}

.lw-icebreaker-select-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(107, 70, 193, 0.4);
}

.lw-icebreaker-select-btn.selected {
    background: linear-gradient(135deg, #C53E8D 0%, #D6589B 100%);
}

.lw-pagination-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background-color: #CBD5E0;
    cursor: pointer;
    transition: all 0.3s ease;
}

.lw-pagination-dot.active {
    background-color: #805AD5;
    width: 12px;
    height: 12px;
}

@media (max-width: 768px) {
    .lw-icebreaker-card-item {
        min-width: calc(100% - 40px);
        max-width: calc(100% - 40px);
        margin: 0 20px;
        height: 360px;
    }

    .lw-icebreaker-carousel {
        padding: 0;
    }

    .lw-icebreaker-slides {
        justify-content: flex-start;
    }
}
</style>

<script>
(function() {
    window.initIcebreakerCarousel = function(icebreakers) {
        const $slidesContainer = $('#lwIcebreakerSlides');
        const $pagination = $('#lwIcebreakerPagination');
        let currentSlide = 0;
        let selectedIcebreakerId = null;

        // Clear existing content
        $slidesContainer.empty();
        $pagination.empty();

        if (!icebreakers || icebreakers.length === 0) {
            return;
        }

        // Background classes for variety
        const bgClasses = ['lw-icebreaker-card-bg-1', 'lw-icebreaker-card-bg-2', 'lw-icebreaker-card-bg-3'];

        // Create cards
        icebreakers.forEach(function(icebreaker, index) {
            const messageParts = icebreaker.message.split('\n\n');
            const statement = messageParts[0] || '';
            const question = messageParts[1] || icebreaker.message;
            const bgClass = bgClasses[index % bgClasses.length];

            const $card = $(`
                <div class="lw-icebreaker-card-item ${bgClass}" data-icebreaker-id="${icebreaker.id}" data-index="${index}">
                    <div>
                        <div class="lw-icebreaker-statement">${statement}</div>
                        <div class="lw-icebreaker-divider"></div>
                        <div class="lw-icebreaker-question">${question}</div>
                    </div>
                    <button type="button" class="lw-icebreaker-select-btn" data-icebreaker-id="${icebreaker.id}">
                        Select
                    </button>
                </div>
            `);

            $slidesContainer.append($card);
        });

        // Create pagination dots
        icebreakers.forEach(function(_, index) {
            const $dot = $('<div>', {
                class: 'lw-pagination-dot' + (index === 0 ? ' active' : ''),
                'data-slide': index
            });
            $pagination.append($dot);
        });

        // Handle Select button click
        $('.lw-icebreaker-select-btn').on('click', function(e) {
            e.stopPropagation();
            const icebreakerID = $(this).data('icebreaker-id');

            // Remove selected state from all buttons
            $('.lw-icebreaker-select-btn').removeClass('selected').text('Select');

            // Add selected state to clicked button
            $(this).addClass('selected').text('Selected');

            // Set the hidden input value
            $('#lwIcebreakerSelect').val(icebreakerID);
            selectedIcebreakerId = icebreakerID;

            // Find the icebreaker message and show preview
            const selectedIcebreaker = icebreakers.find(ib => ib.id == icebreakerID);
            if (selectedIcebreaker) {
                $('#lwMessagePreviewText').text(selectedIcebreaker.message);
                $('#lwMessagePreview').slideDown(300);
            }
        });

        // Handle pagination dot click
        $('.lw-pagination-dot').on('click', function() {
            const slideIndex = $(this).data('slide');
            goToSlide(slideIndex);
        });

        // Slide navigation function
        function goToSlide(index) {
            currentSlide = index;

            // Calculate offset based on screen size
            let offset;
            if (window.innerWidth <= 768) {
                // Mobile: slide by container width
                const containerWidth = $('.lw-icebreaker-carousel').width();
                offset = -index * containerWidth;
            } else {
                // Desktop: slide by card width (200px) + margin (6px * 2)
                offset = -index * 212;
            }

            $slidesContainer.css('transform', `translateX(${offset}px)`);

            // Update active dot
            $('.lw-pagination-dot').removeClass('active');
            $(`.lw-pagination-dot[data-slide="${index}"]`).addClass('active');
        }

        // Optional: Add swipe support for mobile
        let touchStartX = 0;
        let touchEndX = 0;

        $slidesContainer.on('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });

        $slidesContainer.on('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe();
        });

        function handleSwipe() {
            if (touchEndX < touchStartX && currentSlide < icebreakers.length - 1) {
                // Swipe left - next slide
                goToSlide(currentSlide + 1);
            }
            if (touchEndX > touchStartX && currentSlide > 0) {
                // Swipe right - previous slide
                goToSlide(currentSlide - 1);
            }
        }

        // Handle window resize to adjust slide position
        $(window).on('resize', function() {
            goToSlide(currentSlide);
        });
    };
})();
</script>

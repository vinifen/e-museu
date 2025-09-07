export function initImageModal() {
    const modal = document.getElementById("myModal");
    if (!modal) return;

    const images = document.getElementsByClassName("clickable-image");
    const modalImg = document.getElementById("modal-img");
    const captionText = document.getElementById("modal-caption");
    const closeBtn = document.getElementsByClassName("close")[0];

    // Add click event to all clickable images
    Array.from(images).forEach(img => {
        img.addEventListener("click", function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        });
    });

    // Close modal when clicking X
    if (closeBtn) {
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
    }

    // Close modal when clicking outside
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
}

export function initPopoverButtons() {
    // Info icon animation
    $(document).on('click', '.info-icon', function() {
        this.style.transition = 'transform 0.1s ease';
        this.style.transform = 'scale(0.8)';

        setTimeout(() => {
            this.style.transition = 'transform 0.1s ease';
            this.style.transform = 'scale(1.2)';

            setTimeout(() => {
                this.style.transition = 'transform 0.1s ease';
                this.style.transform = 'scale(1)';
            }, 100);
        }, 100);
    });

    // Initialize Bootstrap popovers
    $(document).ready(function() {
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => 
            new bootstrap.Popover(popoverTriggerEl)
        );

        // Also initialize focus trigger for info icons
        const popover = new bootstrap.Popover('.info-icon', {
            trigger: 'focus'
        });
    });
}

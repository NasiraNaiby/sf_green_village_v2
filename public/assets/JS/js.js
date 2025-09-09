document.addEventListener('DOMContentLoaded', function() {
    // Wishlist heart toggle
    const heartButtons = document.querySelectorAll('.heart-btn');
    heartButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const produitId = this.dataset.produitId;

            // Toggle heart icon fill
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-heart-fill');
            icon.classList.toggle('bi-heart');

            // Send fetch request (optional)
            fetch(`/wishlist/toggle/${produitId}`, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(res => res.json())
              .then(data => console.log(data));
        });
    });



//gallery zoom
  mediumZoom('.zoomable', {
            margin: 24,
            background: '#000',
            scrollOffset: 40
        });




        // Activate tab from URL query parameter
  const urlParams = new URLSearchParams(window.location.search);
  const tabId = urlParams.get('tab');

  if(tabId) {
    const tabTriggerEl = document.querySelector(`a[href="#${tabId}"]`);
    if(tabTriggerEl) {
      const tab = new bootstrap.Tab(tabTriggerEl);
      tab.show();
    }
  }

  // Heart toggle for Favoris
  document.querySelectorAll('.heart-btn').forEach(btn => {
      btn.addEventListener('click', function(e) {
          e.preventDefault();
          const produitId = this.dataset.produitId;
          const icon = this.querySelector('i');

          // Toggle icon
          icon.classList.toggle('bi-heart-fill');
          icon.classList.toggle('bi-heart');

          // Send fetch request to toggle favoris
          fetch(`/wishlist/toggle/${produitId}`, {
              method: 'POST',
              headers: { 'X-Requested-With': 'XMLHttpRequest' }
          }).then(res => res.json())
            .then(data => {
                // Remove card if removed
                if (data.removed) {
                    this.closest('.col-md-3').remove();
                }
            });
      });
  });
});
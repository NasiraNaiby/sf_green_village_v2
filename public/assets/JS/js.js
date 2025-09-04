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

    // Handle "View Details" button click
    document.querySelectorAll('.view-details').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('modalNom').textContent = this.dataset.nom;
            document.getElementById('modalPrix').textContent = this.dataset.prix + " €";
            document.getElementById('modalDesc').textContent = this.dataset.desc;
            document.getElementById('modalCategorie').textContent = this.dataset.categorie;
            document.getElementById('modalFournisseur').textContent = this.dataset.fournisseur;
            document.getElementById('modalPhoto').src = this.dataset.photo;

            // Set Add-to-Cart button link dynamically
            document.getElementById('modalAddToCart').onclick = () => {
                window.location.href = "/panier/add/" + this.dataset.id;
            };
        });
    });

    // Simple zoom effect on image
    const img = document.getElementById('modalPhoto');
    img.addEventListener('click', function() {
        if (this.style.transform === "scale(2)") {
            this.style.transform = "scale(1)";
            this.style.cursor = "zoom-in";
        } else {
            this.style.transform = "scale(2)";
            this.style.cursor = "zoom-out";
        }
        this.style.transition = "transform 0.3s ease";
    });




const radioInputMap = {
'use_existing_email': 'checkout[client_email]',
'use_existing_phone': 'checkout[client_phone]',
'use_existing_address': 'checkout[adresseLivraison]',
'use_existing_postal': 'checkout[codePostalLivraison]'
};

Object.keys(radioInputMap).forEach(radioName => {
    document.querySelectorAll('input[name="'+radioName+'"]').forEach(radio => {
        radio.addEventListener('change', function() {
            const input = document.querySelector('[name="'+radioInputMap[radioName]+'"]');
            if (!input) return;
            input.disabled = (this.value === 'yes');
        });
        radio.dispatchEvent(new Event('change')); // set initial state
    });
});

// Checkout modal logic
document.getElementById('checkoutBtn').addEventListener('click', function() {
    const form = document.getElementById('checkoutForm');
    if (form.checkValidity()) {
        const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
        paymentModal.show();
    } else {
        form.reportValidity();
    }
});

document.getElementById('confirmPaymentBtn').addEventListener('click', function() {
    const form = document.getElementById('checkoutForm');
    const paymentMethod = document.getElementById('paymentMethod').value;

    let input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'payment_method';
    input.value = paymentMethod;
    form.appendChild(input);

    form.submit();
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
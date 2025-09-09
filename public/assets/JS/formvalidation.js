document.addEventListener('DOMContentLoaded', () => {

  /*** LOGIN FORM ***/
  const loginForm = document.querySelector('form#loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
      const email = document.getElementById('inputEmail');
      const password = document.getElementById('inputPassword');
      let errors = [];

      if (!email.value) errors.push("Email requis");
      else if (!/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(email.value)) errors.push("Email invalide");

      if (!password.value) errors.push("Mot de passe requis");
      else if (!/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/.test(password.value)) 
        errors.push("Mot de passe doit contenir lettres et chiffres, min 6 caractères");

      if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
      }
    });
  }

  /*** CHECKOUT FORM ***/
  const checkoutForm = document.querySelector('form#checkoutForm');
  if (checkoutForm) {
    const postalInput = document.getElementById('floatingPostal');
    const passwordInput = document.getElementById('floatingPassword'); // if you have password here

    // Live password strength
    const strengthText = document.createElement('small');
    strengthText.style.display = 'block';
    strengthText.style.marginTop = '4px';
    strengthText.style.fontWeight = 'bold';
    if(passwordInput) passwordInput.parentNode.appendChild(strengthText);

    if(passwordInput){
      passwordInput.addEventListener('input', () => {
        const val = passwordInput.value;
        let strength = '';
        if(val.length < 6) strength = 'Trop court';
        else if(/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/.test(val)) strength = 'Fort';
        else strength = 'Moyen';
        strengthText.textContent = `Force du mot de passe: ${strength}`;
        strengthText.style.color = strength === 'Fort' ? 'green' : (strength === 'Moyen' ? 'orange' : 'red');
      });
    }

    checkoutForm.addEventListener('submit', function(e) {
      let errors = [];

      const email = document.getElementById('floatingEmail');
      const phone = document.getElementById('floatingPhone');
      const address = document.getElementById('floatingAddress');
      const postal = document.getElementById('floatingPostal');

      if (!email.value || !/^[^@]+@[^@]+\.[a-zA-Z]{2,}$/.test(email.value)) errors.push("Email invalide");
      if (!phone.value || !/^\+?[0-9]{6,15}$/.test(phone.value)) errors.push("Téléphone invalide");
      if (!address.value || address.value.length < 5) errors.push("Adresse trop courte");
      if (!postal.value || !/^[0-9]{5}$/.test(postal.value)) errors.push("Code postal doit être exactement 5 chiffres");

      if (errors.length > 0) {
        e.preventDefault();
        alert(errors.join("\n"));
      }
    });
  }

  
  

});

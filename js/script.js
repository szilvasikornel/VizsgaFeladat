const emailInput = document.getElementById('email-input');
const emailLabel = document.querySelector('label[for="email-input"]');

// Amikor a mezőre kattintanak
emailInput.addEventListener('focus', () => {
    emailLabel.style.top = '-20px';
    emailLabel.style.fontSize = '14px'; 
    emailLabel.style.color = '#efe9e9';
});

// Amikor elhagyják a mezőt
emailInput.addEventListener('blur', () => {
    if (emailInput.value !== "") {
        // Ha van adat, a címke marad feljebb csúszva
        emailLabel.style.top = '-20px';
        emailLabel.style.fontSize = '14px'; 
        emailLabel.style.color = '#efe9e9'; 
    } else {
        // Ha nincs adat, visszacsúszik a címke az alap helyzetbe
        emailLabel.style.top = '0';
        emailLabel.style.fontSize = '16px'; 
        emailLabel.style.color = '#fff'; 
    }
});

// Ha már van érték a mezőben (beleírtak valamit), a címke feljebb csúszik
if (emailInput.value !== "") {
    emailLabel.style.top = '-20px';
    emailLabel.style.fontSize = '14px';  
    emailLabel.style.color = '#efe9e9'; 
}

function togglePasswordVisibility(passwordFieldId, eyeIconId) {
    let passwordField = document.getElementById(passwordFieldId);
    let eyeIcon = document.getElementById(eyeIconId);
    let icon = eyeIcon.querySelector('i');  // Az ikon elem kiválasztása

    // Ha a jelszó mező típusát "password"-ra állítjuk, a jelszó el van rejtve, ha "text"-re, akkor látható
    if (passwordField.type === "password") {
        passwordField.type = "text"; // A jelszó láthatóvá válik
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye"); // A szem ikont normál szem ikonná cseréljük
    } else {
        passwordField.type = "password"; // A jelszó elrejtődik
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash"); // Áthúzott szem ikont állítunk
    }
}

const form = document.querySelector('form');
const termsCheckbox = document.getElementById('terms-checkbox');
const termsError = document.getElementById('terms-error');

form.addEventListener('submit', function(event) {
    // Ha a checkbox nincs bejelölve
    if (!termsCheckbox.checked) {
        event.preventDefault(); // Megakadályozza az űrlap elküldését
        termsError.style.display = 'block'; // Megjeleníti a hibaüzenetet
    } else {
        termsError.style.display = 'none'; // Ha be van jelölve, elrejti a hibaüzenetet
    }
});


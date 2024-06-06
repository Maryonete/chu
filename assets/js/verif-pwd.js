const uppercaseIndicator = document.getElementById("uppercaseIndicator");
const lowercaseIndicator = document.getElementById("lowercaseIndicator");
const specialCharIndicator = document.getElementById("specialCharIndicator");
const lengthIndicator = document.getElementById("lengthIndicator");

registration_form_password_first.addEventListener("input", () => {
  const password = registration_form_password_first.value;

  // Check if password has at least one uppercase letter
  if (/[A-Z]/.test(password)) {
    uppercaseIndicator.classList.remove("invalid");
    uppercaseIndicator.classList.add("valid");
    uppercaseIndicator.textContent = "1 majuscule ✓";
  } else {
    uppercaseIndicator.classList.remove("valid");
    uppercaseIndicator.classList.add("invalid");
    uppercaseIndicator.textContent = "1 majuscule";
  }

  // Check if password has at least one lowercase letter
  if (/[a-z]/.test(password)) {
    lowercaseIndicator.classList.remove("invalid");
    lowercaseIndicator.classList.add("valid");
    lowercaseIndicator.textContent = "1 minuscule ✓";
  } else {
    lowercaseIndicator.classList.remove("valid");
    lowercaseIndicator.classList.add("invalid");
    lowercaseIndicator.textContent = "1 minuscule";
  }

  // Check if password has at least one digit
  if (/\d/.test(password)) {
    intcaseIndicator.classList.remove("invalid");
    intcaseIndicator.classList.add("valid");
    intcaseIndicator.textContent = "1 chiffre ✓";
  } else {
    intcaseIndicator.classList.remove("valid");
    intcaseIndicator.classList.add("invalid");
    intcaseIndicator.textContent = "1 chiffre";
  }

  // Check if password has at least one special character
  if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
    specialCharIndicator.classList.remove("invalid");
    specialCharIndicator.classList.add("valid");
    specialCharIndicator.textContent = "1 caractère spécial ✓";
  } else {
    specialCharIndicator.classList.remove("valid");
    specialCharIndicator.classList.add("invalid");
    specialCharIndicator.textContent = "1 caractère spécial";
  }

  // Check if password length is greater than 8
  if (password.length > 8) {
    lengthIndicator.classList.remove("invalid");
    lengthIndicator.classList.add("valid");
    lengthIndicator.textContent = "Plus de 8 caractères ✓";
  } else {
    lengthIndicator.classList.remove("valid");
    lengthIndicator.classList.add("invalid");
    lengthIndicator.textContent = "Plus de 8 caractères";
  }
});

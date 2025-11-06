document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    forms.forEach(form => {
        form.addEventListener("submit", function () {
            const button = form.querySelector(".btn-submit");

            if (button) {
                button.disabled = true;
                button.innerHTML = `
                    <span class="spinner-border spinner-border-sm"></span> Processing...
                `;
            }
        });
    });
});
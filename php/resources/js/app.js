import './bootstrap';


document.addEventListener("DOMContentLoaded", function () {
    const errorCard = document.getElementById("errorCard");
    const successCard = document.getElementById("successCard");

    [errorCard, successCard].forEach(card => {
        if (card) {
            // trigger slide down + fade in
            setTimeout(() => {
                card.classList.remove('-translate-y-10', 'opacity-0');
                card.classList.add('translate-y-[155%]', 'opacity-100');
            }, 100); // small delay to ensure transition runs

            // auto hide after 2 seconds
            setTimeout(() => {
                card.classList.remove('translate-y-[155%]', 'opacity-100');
                card.classList.add('-translate-y-10', 'opacity-0');
            }, 2200);
        }
    });
});
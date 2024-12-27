document.addEventListener("DOMContentLoaded", () => {
    const faqItems = document.querySelectorAll(".faq__item");

    faqItems.forEach((item) => {
        const questionButton = item.querySelector(".faq__question");
        const answer = item.querySelector(".faq__answer");

        questionButton.addEventListener("click", () => {
            const isOpen = item.classList.contains("faq__item--open");

            // Fermer tous les autres items
            faqItems.forEach((otherItem) => {
                otherItem.classList.remove("faq__item--open");
                otherItem.querySelector(".faq__answer").style.maxHeight = null;
            });

            // Toggle l'état de l'item actuel
            if (!isOpen) {
                item.classList.add("faq__item--open");
                answer.style.maxHeight = answer.scrollHeight + "px";
            } else {
                item.classList.remove("faq__item--open");
                answer.style.maxHeight = null;
            }
        });
    });
});

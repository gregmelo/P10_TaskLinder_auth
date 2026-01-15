// public/js/confirm.js

document.addEventListener('DOMContentLoaded', () => {
    // Sélectionne tous les liens qui ont un attribut data-confirm
    const confirmLinks = document.querySelectorAll('a[data-confirm]');

    confirmLinks.forEach(link => {
        link.addEventListener('click', (event) => {
            // Empêche l'action par défaut du lien (la navigation)
            event.preventDefault();

            // Récupère le message de confirmation depuis l'attribut
            const message = link.getAttribute('data-confirm');

            // Affiche la boîte de dialogue de confirmation
            if (confirm(message)) {
                // Si l'utilisateur clique sur OK, on autorise l'action de navigation
                window.location.href = link.href;
            }
            // Si l'utilisateur clique sur Annuler, rien ne se passe (l'action est déjà empêchée)
        });
    });
});
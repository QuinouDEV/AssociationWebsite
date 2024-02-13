// Script JavaScript pour gérer les clics sur les questions de la FAQ

    const faqItems = document.querySelectorAll('.faq-item');

    faqItems.forEach(function(item) {
      item.addEventListener('click', function() {
        const isActive = item.classList.contains('active');

        // Fermer tous les blocs de réponse
        faqItems.forEach(function(item) {
          item.classList.remove('active');
          const answer = item.querySelector('.faq-answer');
          answer.classList.remove('active');
        });

        // Ouvrir le bloc de réponse correspondant à la question cliquée si elle n'est pas déjà active
        if (!isActive) {
          item.classList.add('active');
          const answer = item.querySelector('.faq-answer');
          answer.classList.add('active');
        }
      });
    });

    // Fermer les blocs de réponse lorsque vous cliquez ailleurs sur la page
    document.addEventListener('click', function(event) {
      const targetElement = event.target;

      // Vérifier si l'élément cliqué est en dehors de la FAQ
      if (!targetElement.closest('.faq-container')) {
        // Fermer tous les blocs de réponse
        faqItems.forEach(function(item) {
          item.classList.remove('active');
          const answer = item.querySelector('.faq-answer');
          answer.classList.remove('active');
        });
      }
    });
function getTitleForPath(currentPath) {
    switch (currentPath) {
      case '/inscription':
        return 'Inscription';
        case '/connexion':
        return 'Connexion';
        case '/':
        return 'Home';
        case 'thread':
        return 'Thread';
      default:
        return 'Forum'; 
    }
  }
  function getTitleElement() {
    return document.querySelector('title');
  }
  function updateTitle() {
    const currentPath = window.location.pathname;
    const pageTitle = getTitleForPath(currentPath);
    document.title = pageTitle;
  }
updateTitle(); //change dynamiquement la balise title en fonction de l'url

const mobileMenuButton = document.querySelector('.mobile-menu-button');

mobileMenuButton.addEventListener('click', () => {
  mobileMenuButton.classList.toggle('open');
  
});

const menuButton = document.querySelector('.menu-button');
const sideMenu = document.querySelector('.side-menu');

mobileMenuButton.addEventListener('click', () => {
  sideMenu.classList.toggle('active');
});


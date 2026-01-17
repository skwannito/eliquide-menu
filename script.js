document.addEventListener("DOMContentLoaded", function () {
  var toggleBtn = document.querySelector(".menu-toggle");
  var menu = document.querySelector(".menu");

  document.addEventListener("click", function (event) {
    // Vérifier si le clic est à l'intérieur du bouton de bascule ou du menu
    var isClickInsideToggleBtn = toggleBtn.contains(event.target);
    var isClickInsideMenu = menu.contains(event.target);

    // Si le clic est en dehors du bouton de bascule et du menu, masquer le menu
    if (!isClickInsideToggleBtn && !isClickInsideMenu) {
      toggleBtn.classList.remove("active");
      menu.classList.remove("active");
    }
  });

  toggleBtn.addEventListener("click", function (event) {
    // Empêcher la propagation du clic à d'autres éléments
    event.stopPropagation();

    // Bascule la classe 'active' sur l'élément '.menu-toggle'
    toggleBtn.classList.toggle("active");

    // Bascule la classe 'active' sur l'élément '.menu'
    menu.classList.toggle("active");
  });
});
function ouvrirpages() {
  var a = document.getElementById("search").value;

  var inputValue = a.toLowerCase();

  if (
    inputValue.includes("abricot") ||
    inputValue.includes("peche") ||
    inputValue.includes("seven") ||
    inputValue.includes("sins")
  ) {
    window.location.href =
      "http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=sevensins";
  } else if (inputValue.includes("shiva") || inputValue.includes("menth")) {
    window.location.href =
      "http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=shiva";
  } else if (
    inputValue.includes("ragnarok") ||
    inputValue.includes("fruits rouges")
  ) {
    window.location.href =
      "http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=ragnarok";
  } else if (
    inputValue.includes("red pearl") ||
    inputValue.includes("fraise") ||
    inputValue.includes("orange")
  ) {
    window.location.href =
      "http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=redpearl";
  } else if (
    inputValue.includes("secret mango") ||
    inputValue.includes("mangue") ||
    inputValue.includes("mango")
  ) {
    window.location.href =
      "http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=secretmango";
  } else if (inputValue.includes("shinigami") || inputValue.includes("pomme")) {
    window.location.href =
      "http://127.0.0.1/eliquide-menu/pages/eliquide/eliquide-pages.php?id=shinigami";
  } else {
    window.location.href = "http://127.0.0.1/eliquide-menu/404.php";
  }
}

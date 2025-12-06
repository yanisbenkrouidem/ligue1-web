<script>
  function imgSlider(anything) {
    document.querySelector('.starbucks').src = anything;
  }

  let title = " Ligue 1 McDonalds - Yanis ";
  let speed = 200; // Vitesse en millisecondes

  function scrollTitle() {
    title = title.substring(1) + title.charAt(0); // Déplace la première lettre à la fin
    document.title = title;
    setTimeout(scrollTitle, speed);
  }

  scrollTitle();
</script>

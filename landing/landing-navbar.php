<link rel="stylesheet" href="../assets/css/landing-navbar.css">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
<header>
  <a href="landing.php" class="logo" style="text-decoration: none; color: white;">
    <img src="../assets/images/logo.png" alt="" />
    Amrich
  </a>

  <div class="menu-toggle" onclick="toggleMenu()">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <nav>
    <ul id="nav-links">
      <li><a href="../index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="gallery.php">Gallery</a></li>
      <li><a href="careers.php">Careers</a></li>
      </ul>
  </nav>
</header>

<script>
  function toggleMenu() {
    // Toggle the menu dropdown
    document.getElementById('nav-links').classList.toggle('show');
    
    // Toggle the 'X' animation on the hamburger icon
    document.querySelector('.menu-toggle').classList.toggle('active');
  }
</script>
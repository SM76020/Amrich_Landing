<?php
// Determine the correct path prefix based on the calling file's location
$calling_file = debug_backtrace()[0]['file'];
$calling_dir = dirname($calling_file);
$project_root = dirname(dirname(__FILE__)); // Root directory of the project

// Calculate relative path from calling file to project root
$relative_path = '';
$path_parts = explode(DIRECTORY_SEPARATOR, str_replace($project_root, '', $calling_dir));
$depth = count(array_filter($path_parts)); // Count non-empty parts

// Generate the correct number of "../" based on depth
$relative_path = str_repeat('../', $depth);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  
  <!-- Stylesheets -->
  <link rel="stylesheet" href="<?= $relative_path ?>assets/css/navbar.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Scripts -->
  <script src="<?= $relative_path ?>assets/js/main.js" defer></script> 
</head>
<body onload="updateTime()">

  <header class="top-header">
    <div class="left-section">
      <a href="javascript:history.back()" style="text-decoration: none; color: inherit;">
        🕒 <span id="current-time"></span>
      </a>
    </div>

    <div class="center-section">
      <div class="username">
        <i class="fas fa-user-circle"></i> <?= htmlspecialchars($_SESSION['name']) ?>
      </div>
    </div>

    <div class="right-section">
      <a href="<?= $relative_path ?>dashboard/<?php 
        echo ($_SESSION['role_id'] == 4) ? 'admin.php' : 
             (($_SESSION['role_id'] == 3) ? 'management.php' : 'employee.php'); ?>" class="dashboard-btn">
        <i class="fas fa-tachometer-alt"></i> Dashboard
      </a>
      <?php if (isset($_SESSION['role_id']) && $_SESSION['role_id'] == 3): ?>
      <a href="<?= $relative_path ?>dashboard/projects.php" class="projects-btn" style="margin-left:10px;">
        <i class="fas fa-folder-open"></i> Projects
      </a>
      <?php endif; ?>
      <a href="<?= $relative_path ?>auth/logout.php" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
      </a>
    </div>
  </header>

</body>
</html>

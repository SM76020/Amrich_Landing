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
<link rel="stylesheet" href="<?= $relative_path ?>assets/css/footer.css">

<footer class="footer">
  <hr>
  <div class="footer-content">
    <!-- Contact -->
    <p class="footer-item">
      📞 <a href="tel:+913331524952" title="Call Amrich HR">033 31524952</a>
    </p>
    <p class="footer-item">
      📧 <a href="mailto:hrteam.amrich@gmail.com" title="Email Amrich HR">hrteam.amrich@gmail.com</a>
    </p>

    <!-- Social Icons with subtle pop animation -->
    <div class="social-icons">
      <a href="https://in.linkedin.com/company/amrich-marketing-india-private-limited" target="_blank" title="LinkedIn" rel="noopener">
        <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn Icon">
      </a>
      <a href="https://www.google.com/search?q=Amrich+Marketing" target="_blank" title="Google Search" rel="noopener">
        <img src="https://cdn-icons-png.flaticon.com/512/300/300221.png" alt="Google Search Icon">
      </a>
    </div>


    <p class="footer-item">
      &copy; <?php echo date("Y"); ?> Amrich Marketing India. All rights reserved.
    </p>
  </div>
</footer>

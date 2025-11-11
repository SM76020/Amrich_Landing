<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gallery - Amrich Workspace</title>
  <link rel="stylesheet" href="../assets/css/gallery.css">
  <link rel="stylesheet" href="../assets/css/landing-navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body>
  <?php include 'landing-navbar.php'; ?>
  <main>
    <section class="intro-section">
      <div class="intro-container">
        <h1>Our Workspace Gallery</h1>
        <p>
          Explore how each document is processed with care—from scanning to sign-off. 
          Our workflow integrates scanning, quality checks, dual-branch data entry, 
          segregation, and final PDF conversion, ensuring the best results for every project.
        </p>
      </div>
    </section>
    <section class="gallery-section">
      <div class="gallery-container">
        <h2>Workspace Views: The Journey of a Page</h2>
        <div class="photo-grid">
          <!--
              Replace .photo-placeholder div with <img class="photo-img" src="..." alt="" /> for real photos
          -->
          <div class="photo-card">
            <div class="photo-placeholder">
              📑
            </div>
            <div class="photo-content">
              <div class="photo-title">Scanning as per Project</div>
              <div class="photo-description">
                Each page is scanned systematically for individual projects using high-resolution scanners, preserving detail and integrity as the first crucial step in digitization.
              </div>
            </div>
          </div>
          <div class="photo-card">
            <div class="photo-placeholder">
              🏢
            </div>
            <div class="photo-content">
              <div class="photo-title">Data Entry Branch</div>
              <div class="photo-description">
                Simultaneously, another dedicated branch enters vital page details into our record-keeping systems, keeping digital logs synced in real time with the scanning process.
              </div>
            </div>
          </div>
          <div class="photo-card">
            <div class="photo-placeholder">
              👓
            </div>
            <div class="photo-content">
              <div class="photo-title">QC Branch</div>
              <div class="photo-description">
                Our QC (Quality Control) branch rigorously checks the physical and scanned condition of each page, ensuring no flaws or data loss before moving ahead.
              </div>
            </div>
          </div>
          <div class="photo-card">
            <div class="photo-placeholder">
              🗂️
            </div>
            <div class="photo-content">
              <div class="photo-title">Segregation & Organization</div>
              <div class="photo-description">
                Pages are segregated and categorized as per project requirements, efficiently organized for easy retrieval and accurate archival.
              </div>
            </div>
          </div>
          <div class="photo-card">
            <div class="photo-placeholder">
              📄
            </div>
            <div class="photo-content">
              <div class="photo-title">Digital Conversion (PDF)</div>
              <div class="photo-description">
                The checked and organized pages are converted into high-quality PDF files, ready for digital delivery or secure storage.
              </div>
            </div>
          </div>
          <div class="photo-card">
            <div class="photo-placeholder">
              📝
            </div>
            <div class="photo-content">
              <div class="photo-title">Signoff Copy</div>
              <div class="photo-description">
                The final signoff copy is prepared—authenticated and preserved as the official digital record—ensuring the process is complete and verifiable.
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="culture-section">
      <div class="culture-container">
        <h2>Our Work Culture</h2>
        <p>
          At Amrich, we foster an environment that promotes excellence, innovation, and collaboration.
          Our culture is built on core values that drive our success.
        </p>
        <div class="culture-grid">
          <div class="culture-card">
            <div class="culture-icon">🎯</div>
            <h3>Excellence First</h3>
            <p>We maintain the highest standards in every project, ensuring accuracy and quality in all our digitization services.</p>
          </div>
          <div class="culture-card">
            <div class="culture-icon">🤝</div>
            <h3>Team Collaboration</h3>
            <p>Our success is built on teamwork. We believe in open communication and supporting each other to achieve common goals.</p>
          </div>
          <div class="culture-card">
            <div class="culture-icon">🚀</div>
            <h3>Continuous Learning</h3>
            <p>We invest in our team's growth through regular training programs and skill development initiatives.</p>
          </div>
          <div class="culture-card">
            <div class="culture-icon">⚡</div>
            <h3>Innovation Drive</h3>
            <p>We embrace new technologies and methodologies to improve our processes and deliver better results to our clients.</p>
          </div>
          <div class="culture-card">
            <div class="culture-icon">🌟</div>
            <h3>Work-Life Balance</h3>
            <p>We understand the importance of maintaining a healthy work-life balance and create a supportive environment for all employees.</p>
          </div>
          <div class="culture-card">
            <div class="culture-icon">🔒</div>
            <h3>Data Security</h3>
            <p>Security is paramount in everything we do. We maintain strict protocols to protect client information and maintain confidentiality.</p>
          </div>
        </div>
      </div>
    </section>
    <section class="team-section">
      <div class="team-container">
        <h2>Our Team by Numbers</h2>
        <p>
          Behind every successful digitization project is our dedicated team of professionals working with precision and care.
        </p>
        <div class="stats-row">
          <div class="stat-item">
            <div class="stat-number">50+</div>
            <div class="stat-label">Team Members</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">10+</div>
            <div class="stat-label">Years Experience</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">100+</div>
            <div class="stat-label">Projects Completed</div>
          </div>
          <div class="stat-item">
            <div class="stat-number">99%</div>
            <div class="stat-label">Client Satisfaction</div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php include '../includes/footer.php'; ?>
</body>
</html>
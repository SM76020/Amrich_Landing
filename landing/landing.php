<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome to Amrich</title>
  <link rel="stylesheet" href="../assets/css/landing-style.css">
  <link rel="stylesheet" href="../assets/css/landing-navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
  <?php include 'landing-navbar.php'; ?>

  <main>
    <section class="intro-section">
      <div class="intro-container">
        <h1>Welcome to Amrich</h1>
        <p>Your trusted partner in transforming physical documents into secure, accessible, and high-quality digital assets. We are committed to helping businesses streamline their operations and protect valuable information for the future.</p>
      </div>
    </section>

    <section class="hero-section">
      <div class="hero-container">
        <div class="hero-content">
          <h2>Digitization Services</h2>
          <p>
            We specialize in transforming physical documents, records, and data into high-quality digital formats. Our digitization services help businesses preserve important information, improve accessibility, and streamline operations.
          </p>
          <div class="process-steps">
            <p>Our process includes:</p>
            <ul>
              <li><strong>Scanning:</strong>  Our expert employees handle the initial conversion.</li>
              <li><strong>Quality Check:</strong>  Our dedicated QC team ensures accuracy and integrity.</li>
              <li><strong>Delivery:</strong>  We deliver the final digital assets to the client with full assurance.</li>
            </ul>
          </div>
          <a href="quote.php" class="cta-button">Get a Quote</a>
        </div>
        <div class="hero-illustration">
          <img src="../assets/images/digitization-illustration.png" alt="Digitization Workflow Illustration">
        </div>
      </div>
    </section>

    <section class="why-us-section">
      <div class="why-us-container">
        <h2>Why Choose Us?</h2>
        <div class="features-grid">
          <div class="feature-card">
            <h3>Expert Team</h3>
            <p>Our professionals are highly trained and experienced in handling a wide variety of documents and data types.</p>
          </div>
          <div class="feature-card">
            <h3>Data Security</h3>
            <p>We use advanced security protocols to ensure the confidentiality and integrity of your sensitive information.</p>
          </div>
          <div class="feature-card">
            <h3>Custom Solutions</h3>
            <p>We tailor our services to meet the specific needs of your business, ensuring a perfect fit for your workflow.</p>
          </div>
        </div>
      </div>
    </section>
    
    <section class="clients-section">
      <div class="clients-container">
        <h2>Trusted by Industry Leaders</h2>
        <div class="client-logos">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQcWoXBhVCqXECXOcKdKfyYGsI7qBCovDaMzA&s" alt="Client Logo 1">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRLsxuYB2dbZYklwaWOiw0l8WRpYWQ4sWMdJA&s" alt="Client Logo 2">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcThP-W0IDHArVITtVmO_PnPdLmPzBn2SS1vDg&s" alt="Client Logo 3">
          <img src="https://upload.wikimedia.org/wikipedia/en/6/66/Emblem_of_West_Bengal_%282018-present%29.svg" alt="Client Logo 4">
          <img src="https://rgmwb.gov.in/MARREG_Images/Portal/marreg_new_logo.png" alt="Client Logo 5">
        </div>
      </div>
    </section>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
<?php 
require_once '../config/db.php';

// Fetch active projects and their data counts
try {
    $stmt = $pdo->query("SELECT name, client_name, data_count, description FROM projects WHERE status = 'active' ORDER BY name");
    $active_projects = $stmt->fetchAll();
} catch (Exception $e) {
    $active_projects = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our Services - Amrich</title>
  <link rel="stylesheet" href="../assets/css/landing-style.css">
  <link rel="stylesheet" href="../assets/css/landing-navbar.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --main: #005f73;
      --accent: #ffb703;
      --bg-light: #f5f7fa;
      --text-dark: #232946;
      --white: #fff;
      --soft-shadow: 0 4px 18px 0 rgba(31, 38, 135, 0.09);
      --section-pad: 6rem 1.5rem 3rem 1.5rem;
      --radius: 22px;
      --anim-ease: cubic-bezier(.7,.36,0,1.01);
    }
    html, body {
      scroll-behavior: smooth;
      background: var(--bg-light);
      color: var(--text-dark);
    }
    body {
      font-family: 'Poppins', 'Roboto', Arial, sans-serif;
    }
    .intro-section {
      padding: 4rem 2rem 2rem 2rem;
      background: linear-gradient(120deg, var(--main) 60%, #48cae4 100%);
      color: var(--white);
      text-align: center;
      position: relative;
      overflow: hidden;
      animation: fadeInSlideDown 1s var(--anim-ease);
      border-radius: 0 0 var(--radius) var(--radius);
    }
    .intro-section:after {
      content: "";
      position: absolute;
      width: 160px;
      height: 160px;
      background: radial-gradient(circle at 80% 10%, var(--accent) 30%, transparent 70%);
      top: -50px; right: -80px;
      opacity: 0.18;
      z-index: 0;
      pointer-events: none;
      animation: glowMove 7s infinite alternate-reverse;
    }
    .intro-container h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1.1rem;
      letter-spacing: 1px;
      animation: fadeDown 0.8s both;
    }
    .intro-container p {
      font-size: 1.25rem;
      font-weight: 400;
      margin-bottom: 0;
      color: #e3ecf7;
      animation: fadeUp 0.9s 0.3s both;
    }

    /* Services Section */
    .services-section {
      padding: 4rem 1.5rem 5rem 1.5rem;
      background: linear-gradient(135deg, var(--bg-light) 90%, #e9ecef 100%);
      position: relative;
      z-index: 2;
    }
    .services-container {
      max-width: 1200px;
      margin: 0 auto;
    }
    .services-container h2 {
      text-align: center;
      font-size: 2.4rem;
      color: var(--main);
      font-weight: 700;
      margin-bottom: 2.7rem;
      letter-spacing: 1px;
      animation: fadeDown 1.1s both;
    }

    .service-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
      gap: 2.5rem;
      margin-bottom: 3.5rem;
    }
    .service-card {
      background: white;
      padding: 2.7rem 2.1rem 2.5rem 2.1rem;
      border-radius: 20px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.13), 0 2px 8px #ffb70311;
      transition:
        transform 0.35s var(--anim-ease),
        box-shadow 0.3s var(--anim-ease),
        border-color 0.3s var(--anim-ease);
      border-left: 6px solid var(--main);
      position: relative;
      overflow: hidden;
      will-change: transform;
      opacity: 0;
      animation: cardAppear 0.9s cubic-bezier(.56,1.24,.46,1.01) forwards;
    }
    .service-card:nth-child(1) { animation-delay: .05s; }
    .service-card:nth-child(2) { animation-delay: .13s; }
    .service-card:nth-child(3) { animation-delay: .22s; }
    .service-card:nth-child(4) { animation-delay: .31s; }
    .service-card:nth-child(5) { animation-delay: .41s; }
    .service-card:nth-child(6) { animation-delay: .5s; }
    .service-card:before {
      content: "";
      position: absolute;
      top: -60px; right: -60px;
      width: 120px; height: 120px;
      background: radial-gradient(circle at 65% 35%, var(--accent) 32%, transparent 78%);
      opacity: 0.13;
      z-index: 0;
      pointer-events: none;
      animation: floatGlow 9s infinite alternate-reverse;
    }
    .service-card:hover {
      transform: translateY(-15px) scale(1.03) rotateZ(-1.4deg);
      box-shadow: 0 18px 52px 0 rgba(31, 38, 135, 0.22),
                  0 8px 22px 0 #ffe6ac75;
      border-left: 6px solid var(--accent);
    }
    .service-card h3 {
      color: var(--main);
      font-size: 1.8rem;
      margin-bottom: 1.05rem;
      display: flex;
      align-items: center;
      gap: 14px;
      font-weight: 700;
      z-index: 2;
      letter-spacing: 1px;
      animation: fadeDown 0.9s 0.06s both;
    }
    .service-card p {
      color: #434f61;
      line-height: 1.7;
      font-size: 1.11rem;
      z-index: 2;
      animation: fadeUp 0.9s 0.1s both;
    }
    .service-icon {
      font-size: 2.3rem;
      color: var(--accent);
      transition: color 0.22s;
      filter: drop-shadow(0 3px 9px #ffb7033f);
      will-change: filter, color;
      animation: iconPop 1.1s cubic-bezier(.44,.09,.62,1.2);
    }
    .service-card:hover .service-icon {
      color: var(--main);
      filter: drop-shadow(0 2px 12px #005f734f);
    }

    /* Why Us Section */
    .why-us-section {
      padding: 4.5rem 1.8rem 3rem 1.8rem;
      background: linear-gradient(110deg, #e9ecef 55%, #c5e6ed 100%);
      border-radius: var(--radius) var(--radius) 0 0;
      margin-top: 1rem;
      box-shadow: 0 -2px 28px 0 rgba(31, 38, 135, 0.09);
      position: relative;
      z-index: 1;
      overflow: hidden;
    }
    .why-us-container {
      max-width: 1100px;
      margin: 0 auto;
    }
    .why-us-container h2 {
      text-align: center;
      font-size: 2.2rem;
      color: var(--main);
      font-weight: 700;
      margin-bottom: 2.1rem;
      letter-spacing: 1px;
      animation: fadeDown 1s both;
    }
    .features-grid {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      justify-content: center;
      align-items: stretch;
    }
    .feature-card {
      background: var(--white);
      border-radius: 15px;
      padding: 2.2rem 1.4rem 1.5rem;
      box-shadow: 0 7px 24px 0 rgba(31, 38, 135, 0.12);
      min-width: 260px;
      max-width: 370px;
      flex: 1 1 290px;
      text-align: center;
      transition: transform 0.33s var(--anim-ease), box-shadow 0.3s;
      border-bottom: 4px solid var(--main);
      opacity: 0;
      animation: cardAppear 1s cubic-bezier(.56,1.24,.46,1.01) forwards;
    }
    .feature-card:nth-child(1) { animation-delay: .12s; }
    .feature-card:nth-child(2) { animation-delay: .25s; }
    .feature-card:nth-child(3) { animation-delay: .36s; }
    .feature-card:hover {
      transform: translateY(-10px) scale(1.04) rotateZ(-1.2deg);
      box-shadow: 0 13px 42px 0 rgba(31,38,135,0.18),
        0 7px 20px 0 #ffe6ac36;
      border-bottom: 4px solid var(--accent);
      background: linear-gradient(120deg, #fff 85%, #fff0d6 100%);
    }
    .feature-card h3 {
      font-size: 1.25rem;
      color: var(--main);
      margin-bottom: 0.7rem;
      font-weight: 700;
      animation: fadeDown 1.1s both;
    }
    .feature-card p {
      color: #505b66;
      font-size: 1.09rem;
      margin-bottom: 0;
      animation: fadeUp 1s 0.12s both;
    }
    /* Animations */
    @keyframes fadeInSlideDown {
      from { opacity: 0; transform: translateY(-40px);}
      to   { opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeDown {
      from { opacity: 0; transform: translateY(-30px);}
      to   { opacity: 1; transform: translateY(0);}
    }
    @keyframes fadeUp {
      from { opacity: 0; transform: translateY(26px);}
      to   { opacity: 1; transform: translateY(0);}
    }
    @keyframes cardAppear {
      from { opacity: 0; transform: translateY(32px) scale(.97);}
      to { opacity: 1; transform: translateY(0) scale(1);}
    }
    @keyframes iconPop {
      0% { transform: scale(0.6); }
      65% { transform: scale(1.13);}
      100% { transform: scale(1);}
    }
    @keyframes floatGlow {
      from { transform: translateY(0);}
      to { transform: translateY(30px);}
    }
    @keyframes glowMove {
      from { transform: translateY(0);}
      to { transform: translateY(50px);}
    }

    /* Responsive Styles */
    @media (max-width: 1100px) {
      .services-container, .projects-container, .why-us-container { max-width: 96vw; }
    }
    @media (max-width: 950px) {
      .service-grid { grid-template-columns: 1fr 1fr;}
      .features-grid { flex-direction: column; align-items: center;}
    }
    @media (max-width: 700px) {
      .intro-section { padding: 2.2rem 1rem 1.5rem 1rem; }
      .intro-container h1 { font-size: 2.1rem;}
      .intro-container p { font-size: 1.1rem;}
      .services-section, .why-us-section { padding: 2rem 0.6rem 2rem 0.6rem;}
      .service-grid { grid-template-columns: 1fr; gap: 1.2rem;}
      .service-card { padding: 1.3rem;}
      .why-us-container h2 { font-size: 1.35rem; margin-bottom: 1.2rem;}
      .feature-card { min-width: 80vw; max-width: 99vw; padding: 1.1rem; }
      .features-grid { gap: 1rem;}
    }
    @media (max-width: 520px) {
      .service-card h3 { font-size: 1.25rem;}
      .service-icon { font-size: 1.4rem;}
      .service-card, .feature-card { padding: .8rem;}
    }
    @media (max-width: 400px) {
      .intro-section{padding: 1rem;}
    }
  </style>
</head>
<body>
  <?php include 'landing-navbar.php'; ?>

  <main>
    <section class="intro-section">
      <div class="intro-container">
        <h1>Our Services</h1>
        <p>Comprehensive digitization solutions tailored to meet your business needs. We transform your physical documents into secure, accessible, and high-quality digital assets.</p>
      </div>
    </section>

    <section class="services-section">
      <div class="services-container">
        <h2>What We Offer</h2>
        <div class="service-grid">
          <div class="service-card">
            <h3>
              <span class="service-icon" aria-label="Document Scanning" role="img">📄</span>
              Document Scanning
            </h3>
            <p>High-resolution scanning of documents, books, records, and archives. We handle various formats including legal documents, historical records, and business files with precision and care.</p>
          </div>
          <div class="service-card">
            <h3>
              <span class="service-icon" aria-label="Quality Control" role="img">🔍</span>
              Quality Control
            </h3>
            <p>Our dedicated QC team ensures every digitized document meets the highest quality standards. We perform thorough checks for clarity, completeness, and accuracy before delivery.</p>
          </div>
          <div class="service-card">
            <h3>
              <span class="service-icon" aria-label="Data Processing" role="img">🗂️</span>
              Data Processing
            </h3>
            <p>Advanced data extraction and processing services including OCR (Optical Character Recognition), indexing, and metadata creation to make your digital documents searchable and organized.</p>
          </div>
          <div class="service-card">
            <h3>
              <span class="service-icon" aria-label="Secure Delivery" role="img">🔒</span>
              Secure Delivery
            </h3>
            <p>We prioritize data security with encrypted storage and secure delivery methods. Your sensitive information is protected throughout the entire digitization process.</p>
          </div>
          <div class="service-card">
            <h3>
              <span class="service-icon" aria-label="Fast Turnaround" role="img">⚡</span>
              Fast Turnaround
            </h3>
            <p>Efficient workflow processes and experienced team enable us to deliver projects within agreed timelines without compromising on quality.</p>
          </div>
          <div class="service-card">
            <h3>
              <span class="service-icon" aria-label="Custom Solutions" role="img">🎯</span>
              Custom Solutions
            </h3>
            <p>Tailored digitization solutions designed to meet specific client requirements. We adapt our processes to suit your industry needs and project specifications.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional: You may later restore the projects-section, but leaving hidden for now. -->

    <section class="why-us-section">
      <div class="why-us-container">
        <h2>Why Choose Amrich?</h2>
        <div class="features-grid">
          <div class="feature-card">
            <h3>Industry Expertise</h3>
            <p>Years of experience in digitizing documents across various industries including government, healthcare, legal, and corporate sectors.</p>
          </div>
          <div class="feature-card">
            <h3>Advanced Technology</h3>
            <p>State-of-the-art scanning equipment and software to ensure the highest quality digitization results.</p>
          </div>
          <div class="feature-card">
            <h3>Scalable Solutions</h3>
            <p>From small batch processing to large-scale enterprise digitization projects, we can handle any volume efficiently.</p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>
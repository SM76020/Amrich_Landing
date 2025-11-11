<?php
require_once '../config/db.php';

$positions = [];
try {
    $stmt = $pdo->query("SELECT post FROM job_posting ORDER BY post ASC");
    $positions = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    $error = "Could not load job positions: " . $e->getMessage();
}

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name          = trim($_POST['name']);
    $qualification = trim($_POST['qualification']);
    $position      = trim($_POST['position']);
    $address       = trim($_POST['address']);
    $mobile        = trim($_POST['mobile']);

    try {
        $stmt = $pdo->prepare("
          INSERT INTO job_applications
            (name, qualification, position, address, mobile)
          VALUES
            (:name, :qualification, :position, :address, :mobile)
        ");
        $stmt->execute([
          ':name'          => $name,
          ':qualification' => $qualification,
          ':position'      => $position,
          ':address'       => $address,
          ':mobile'        => $mobile,
        ]);
        $success = true;
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Job Application | Amrich</title>
  <link rel="stylesheet" href="../assets/css/landing-style.css">
  <link rel="stylesheet" href="../assets/css/landing-navbar.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/job-application.css">
  <style>
    .back-btn-area {
      display: flex;
      gap: 1em;
      margin-bottom: 1.3em;
    }
    .back-to-jobs-btn {
      background-color: #084b86;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 0.68em 1.22em;
      font-size: 1em;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(10,60,90,0.08);
      transition: background 0.18s;
      margin-bottom: 0;
      text-decoration: none;
      display: inline-block;
    }
    .back-to-jobs-btn:hover {
      background-color: #21629c;
    }
  </style>
</head>
<body>

<?php include 'landing-navbar.php'; ?>

<!-- <header class="application-header">
  <h1>Join Our Team</h1>
  <p>Fill out the form to apply for an open position.</p>
</header> -->

<main class="application-container">

  <?php if (!empty($success)): ?>
    <div class="success-message">
      <h2>Thank you!</h2>
      <p>Your application has been submitted successfully.</p>
      <p>Redirecting you to Job List in 3 seconds…</p>
    </div>
    <script>
      setTimeout(() => window.location.href = 'careers.php', 3000);
    </script>
  <?php elseif (!empty($error)): ?>
    <div class="error-message">
      <h2>Submission Error</h2>
      <p><?= htmlspecialchars($error) ?></p>
    </div>
  <?php endif; ?>

  <?php if (empty($positions)): ?>
    <div class="error-message">
      <p>No job positions are available at the moment. Please check back later.</p>
    </div>
  <?php else: ?>    
    <form action="" method="POST" class="application-form card">
    <div class="back-btn-area">
    <a href="careers.php" class="back-to-jobs-btn">&larr; Back to Job List</a>
  </div>
      <h2 class="form-title">Application Form</h2>
      <div class="form-grid">
        <div class="form-group">
          <label for="name">Full Name</label>
          <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
          <label for="qualification">Qualification</label>
          <input type="text" id="qualification" name="qualification" required>
        </div>

        <div class="form-group">
          <label for="position">Position</label>
          <select id="position" name="position" required>
            <option value="" disabled selected>-- Select Position --</option>
            <?php foreach ($positions as $pos): ?>
              <option value="<?= htmlspecialchars($pos) ?>"><?= htmlspecialchars($pos) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="form-group">
          <label for="mobile">Mobile Number</label>
          <input type="tel" id="mobile" name="mobile" pattern="[0-9]{10}" placeholder="10-digit number" required>
        </div>

        <div class="form-group full-width">
          <label for="address">Address</label>
          <textarea id="address" name="address" rows="3" required></textarea>
        </div>
      </div>

      <button type="submit" class="submit-btn">Submit Application</button>
    </form>
  <?php endif; ?>
</main>

</body>
</html>

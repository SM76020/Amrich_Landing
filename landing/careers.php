<?php
  // careers.php
  require_once '../config/db.php';

  try {
    $stmt = $pdo->query("SELECT post, office_address, qualification, salary FROM job_posting ORDER BY id DESC");
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  
  <title>Careers | Amrich</title>

  <!-- Shared styles -->
  <link rel="stylesheet" href="../assets/css/landing-style.css">
  <link rel="stylesheet" href="../assets/css/landing-navbar.css">
  <link rel="stylesheet" href="../assets/css/careers.css">
  <link rel="stylesheet" href="../assets/css/footer.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

  <!-- 1) Fixed navbar -->
  <?php include 'landing-navbar.php'; ?>

  <!-- 3) Table and CTA -->
  <main>
    <table class="job-table">
      <thead>
        <tr>
          <th>Post</th>
          <th>Office Address</th>
          <th>Qualification</th>
          <th>Salary</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($jobs)): ?>
          <?php foreach ($jobs as $job): ?>
            <tr>
              <td><?php echo htmlspecialchars($job['post']); ?></td>
              <td><?php echo htmlspecialchars($job['office_address']); ?></td>
              <td><?php echo htmlspecialchars($job['qualification']); ?></td>
              <td>Rs <?php echo htmlspecialchars($job['salary']); ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="4">No job postings available at the moment.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>

    <div class="cta">
      <form action="job-application.php">
        <button type="submit">Apply Now</button>
      </form>
      <form action="track-status.php">
        <button>Track Your Status</button>
      </form>
    </div>
  </main>

  <?php include '../includes/footer.php'; ?>
</body>
</html>

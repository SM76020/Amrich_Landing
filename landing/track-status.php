<?php
require_once '../config/db.php';

$statusResult = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = trim($_POST['input']);

    if ($input === '') {
        $error = "Please enter Interview ID or Mobile Number.";
    } else {
        // Try to find by Interview ID
        $stmt = $pdo->prepare("SELECT * FROM interview_applicants WHERE interview_id = ?");
        $stmt->execute([$input]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $statusResult = [
                'method' => 'Interview ID',
                'interview_id' => $result['interview_id'],
                'mobile' => $result['mobile'],
                'status' => $result['status']
            ];
        } else {
            // Try to find by Mobile Number (corrected column name to 'mobile')
            $stmt = $pdo->prepare("SELECT * FROM interview_applicants WHERE mobile = ? ORDER BY id DESC LIMIT 1");
            $stmt->execute([$input]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $statusResult = [
                    'method' => 'Mobile Number',
                    'interview_id' => $result['interview_id'],
                    'mobile' => $result['mobile'],
                    'status' => $result['status']
                ];
            } else {
                $error = "No status found for the provided input.";
            }
        }
    }
}
?>
  <?php include '../landing/landing-navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Track Interview Status</title>
  <link rel="stylesheet" href="../assets/css/track-status.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="form-container">
  <h2>Track Your Application Status</h2>
  <form method="POST">
    <label>Enter Interview ID or Mobile Number:</label><br><br>
    <input type="text" name="input" placeholder="e.g., AMIV0001 or 9876543210" required>
    <button type="submit">Check Status</button>
  </form>

  <?php if ($statusResult): ?>
    <div class="status-box 
      <?= $statusResult['status'] === 'Selected' ? 'status-success' : 
         ($statusResult['status'] === 'Rejected' ? 'status-reject' : '') ?>">
      <p><strong>Search Method:</strong> <?= $statusResult['method'] ?></p>
      <p><strong>Interview ID:</strong> <?= htmlspecialchars($statusResult['interview_id']) ?></p>
      <p><strong>Mobile:</strong> <?= htmlspecialchars($statusResult['mobile']) ?></p>
      <p><strong>Status:</strong> <?= strtoupper($statusResult['status']) ?></p>
    </div>
  <?php elseif ($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>
</div>
<?php include '../includes/footer.php'; ?>
</body>
</html>

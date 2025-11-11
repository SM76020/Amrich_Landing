<?php
// quote.php
// Use config/db.php for DB connection (PDO)

session_start();
require_once __DIR__ . '/../config/db.php'; 

// Helper: sanitize for HTML output
function e($str) {
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

// Process POST
$errors = [];
$success_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic inputs
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Validation
    if ($name === '') {
        $errors[] = 'Name is required.';
    }
    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email is required.';
    }
    // phone optional but sanitize length
    if ($phone !== '' && strlen($phone) > 50) {
        $errors[] = 'Phone number is too long.';
    }
    if (strlen($service) > 200) {
        $errors[] = 'Service value is too long.';
    }

    if (empty($errors)) {
        // Insert into database (PDO)
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO `quotes` (`name`, `email`, `phone`, `service`, `message`) VALUES (:name, :email, :phone, :service, :message)"
            );
            $stmt->execute([
                ':name'    => $name,
                ':email'   => $email,
                ':phone'   => $phone,
                ':service' => $service,
                ':message' => $message
            ]);
            $insert_id = $pdo->lastInsertId();
            $success_msg = 'Thank you — your request has been submitted.';

            // Prepare email content
            $subject = "New Quote Request (#{$insert_id})";
            $body = "A new quote request has been submitted.\n\n";
            $body .= "ID: {$insert_id}\n";
            $body .= "Name: {$name}\n";
            $body .= "Email: {$email}\n";
            $body .= "Phone: {$phone}\n";
            $body .= "Service: {$service}\n";
            $body .= "Message:\n{$message}\n\n";
            $body .= "Submitted at: " . date('Y-m-d H:i:s') . "\n";

            // Headers
            $to_admin = 'rana@amrichindia.com';
            $headers_admin = "From: " . e($name) . " <" . e($email) . ">\r\n";
            $headers_admin .= "Reply-To: " . e($email) . "\r\n";
            $headers_admin .= "Content-Type: text/plain; charset=utf-8\r\n";

            // Send mail to admin
            @mail($to_admin, $subject, $body, $headers_admin);

            // Send confirmation to user (optional)
            $to_user = $email;
            $subject_user = "We received your quote request";
            $body_user = "Hello " . $name . ",\n\n";
            $body_user .= "Thank you for contacting us. We received your quote request with the following details:\n\n";
            $body_user .= "Service: " . ($service ?: 'Not specified') . "\n";
            $body_user .= "Message: \n" . ($message ?: 'No message provided') . "\n\n";
            $body_user .= "We will get back to you soon.\n\n";
            $body_user .= "— Amrich India\n";
            $headers_user = "From: Amrich India <" . $to_admin . ">\r\n";
            $headers_user .= "Content-Type: text/plain; charset=utf-8\r\n";

            @mail($to_user, $subject_user, $body_user, $headers_user);

            // Optional: clear POST values so form resets
            $_POST = [];
        } catch (PDOException $e) {
            $errors[] = 'Failed to save request: ' . $e->getMessage();
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Request a Quote</title>
<link rel="stylesheet" href="../assets/css/landing-style.css">
<link rel="stylesheet" href="../assets/css/landing-navbar.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap">
<style>
    body {
        font-family: 'Poppins', Arial, sans-serif;
        margin: 0;
        background: linear-gradient(120deg,#005f73 56%,#48cae4 100%);
        min-height: 100vh;
        color: #22223b;
        }
    .navbar {
        margin-bottom: 0;
    }
    .quote-main-container {
        max-width: 480px;
        background: #fff;
        margin: 54px auto 30px auto;
        border-radius: 18px;
        box-shadow: 0 8px 38px rgba(0,79,125,0.14), 0 1.5px 10px #c5e0f768;
        padding: 2.2rem 2.2rem 2.2rem 2.2rem;
        animation: fadeInPage 1.1s both;
    }
    @keyframes fadeInPage {
        from { opacity:0; transform: translateY(28px);}
        to   { opacity:1; transform: none;}
    }
    h1.quote-title {
        font-size: 2.2rem;
        font-weight: 700;
        text-align: center;
        letter-spacing: .04em;
        color: #005f73;
        margin-bottom: 1.5rem;
        margin-top: .2rem;
        animation: slideDownFade 0.9s .08s both;
    }
    @keyframes slideDownFade {
        from { opacity: 0; transform: translateY(-28px);}
        to { opacity: 1; transform: none;}
    }
    .quote-form label {
        display: block;
        margin-bottom: 0.39rem;
        font-weight: 600;
        color: #22223b;
        font-size: 1.04rem;
        letter-spacing: .01em;
        transition: color .24s;
    }
    .quote-form input[type="text"],
    .quote-form input[type="email"],
    .quote-form textarea {
        width: 93%;
        padding: 11px 13px;
        border: 1.5px solid #abdee7;
        border-radius: 8px;
        font-size: 1.06rem;
        margin-bottom: 12px;
        transition: border-color .22s, box-shadow .22s;
        font-family: inherit;
        background: #f3fcff;
        color: #003049;
        box-shadow: 0 1.5px 7px #005f7324;
    }
    .quote-form input[type="text"]:focus,
    .quote-form input[type="email"]:focus,
    .quote-form textarea:focus {
        border-color: #005f73;
        background: #eaf3fa;
        outline: none;
        box-shadow: 0 3px 18px #005f7320;
    }
    .quote-form button {
        margin-top: 14px;
        background: linear-gradient(90deg,#005f73 60%,#1fa6bb 100%);
        color: #fff;
        font-size: 1.15rem;
        font-weight: 600;
        letter-spacing: .02em;
        border: none;
        padding: 0.82rem 0;
        border-radius: 8px;
        box-shadow: 0 2px 13px #005f735a;
        cursor: pointer;
        width: 100%;
        transition: background .22s, transform .16s;
        animation: fadeInButton 1.05s .2s both;
    }
    .quote-form button:hover {
        background: linear-gradient(90deg,#0080d0 60%,#0056b3 100%);
        transform: scale(1.025) translateY(-2px);
    }
    @keyframes fadeInButton {
        from { opacity:0; transform:scale(.93);}
        to   { opacity:1; transform:none;}
    }
    .quote-msg,
    .quote-success {
        margin-bottom: 1.09rem;
        padding: 15px 16px 15px 46px;
        border-radius: 9px;
        font-size: 1.04rem;
        line-height: 1.6;
        position: relative;
        box-shadow: 0 1.5px 8px #005f7322;
        animation: fadeInPage .9s;
    }
    .quote-msg {
        background: #ffe6e6;
        border: 1.5px solid #ffb3b3;
        color: #be2d34;
    }
    .quote-success {
        background: #e6ffea;
        border: 1.5px solid #b3ffcc;
        color: #197a53;
        animation: fadeInPage .7s .1s;
    }
    .quote-msg:before {
        content: "!";
        font-weight: bold;
        font-size: 1.5rem;
        color: #eb2323;
        position: absolute;
        left: 16px; top: 10px;
        font-family: 'Poppins', Arial, sans-serif;
    }
    .quote-success:before {
        content: "✓";
        font-weight: bold;
        font-size: 1.5rem;
        color: #19ba31;
        position: absolute;
        left: 15px; top: 10px;
        font-family: 'Poppins', Arial, sans-serif;
    }

    @media (max-width: 770px) {
        body { padding: 0; }
        .quote-main-container { max-width:96vw; padding: 1.15rem 0.7rem 1.7rem 0.7rem;}
    }
    @media (max-width: 450px) {
        .quote-main-container { padding: 0.55rem 0.12rem 1.22rem 0.12rem;}
        h1.quote-title { font-size: 1.19rem;}
        .quote-form label { font-size: .97rem;}
        .quote-form button { font-size: .99rem;}
    }
    /* Nice subtle shine on submit button on hover */
    .quote-form button::after {
        content: '';
        position: absolute;
        display: block;
        left: 0; top: 0; right: 0; bottom: 0;
        border-radius:8px;
        pointer-events:none;
        background: linear-gradient(90deg,rgba(255,255,255,0.17) 0%,rgba(255,255,255,0.04) 100%);
        opacity: 0.7;
        transition: opacity .4s;
    }
    .quote-form button:hover::after { opacity: 1; }
</style>
</head>
<body>
    <?php include 'landing-navbar.php'; ?>

    <main>
        <div class="quote-main-container">
            <h1 class="quote-title">Request a Quote</h1>

            <?php if (!empty($errors)): ?>
                <div class="quote-msg">
                    <strong>Please fix the following:</strong>
                    <ul style="margin-top:7px;margin-bottom:0;">
                        <?php foreach ($errors as $err): ?>
                            <li><?php echo e($err); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($success_msg): ?>
                <div class="quote-success"><?php echo e($success_msg); ?></div>
            <?php endif; ?>

            <form method="post" class="quote-form" action="" autocomplete="on" novalidate>
                <label for="name">Full name *</label>
                <input id="name" name="name" type="text" required value="<?php echo e($_POST['name'] ?? ''); ?>" maxlength="100" placeholder="Your Name">

                <label for="email">Email *</label>
                <input id="email" name="email" type="email" required value="<?php echo e($_POST['email'] ?? ''); ?>" maxlength="120" placeholder="you@email.com">

                <label for="phone">Phone</label>
                <input id="phone" name="phone" type="text" value="<?php echo e($_POST['phone'] ?? ''); ?>" maxlength="50" placeholder="Optional">

                <label for="service">Service required (e.g., 'PDF automation', 'Website')</label>
                <input id="service" name="service" type="text" value="<?php echo e($_POST['service'] ?? ''); ?>" maxlength="200" placeholder="What do you need?">

                <label for="message">Message / Details</label>
                <textarea id="message" name="message" rows="6" placeholder="Add more details"><?php echo e($_POST['message'] ?? ''); ?></textarea>

                <button type="submit">Submit</button>
            </form>
        </div>
    </main>
</body>
</html>

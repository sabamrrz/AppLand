<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// بارگذاری خودکار Composer
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // دریافت اطلاعات فرم
    $name = $_POST['name'] ?? 'name';
    $email = $_POST['email'] ?? 'email';
    $subject = $_POST['subject'] ?? 'subject';
    $message = $_POST['message'] ?? 'message';

    $mail = new PHPMailer(true);

    try {
        // تنظیمات SMTP هاست
        $mail->isSMTP();
        $mail->Host = 'mail.codebanoo.org'; // آدرس سرور SMTP هاست شما
        $mail->SMTPAuth = true;
        $mail->Username = 'saba@codebanoo.org'; // ایمیل شما در هاست
        $mail->Password = 'codE@6080'; // رمز عبور ایمیل شما
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // یا PHPMailer::ENCRYPTION_SMTPS برای پورت 465
        $mail->Port = 587; // پورت TLS (یا 465 برای SMTPS)

        // تنظیمات ارسال‌کننده و گیرنده
        $mail->setFrom('saba@codebanoo.org', 'Saba'); // ایمیل فرستنده
        $mail->addAddress('saba@codebanoo.org'); // گیرنده ایمیل

        // تنظیمات محتوا
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <h2>New message</h2>
            <p><strong>name:</strong> {$name}</p>
            <p><strong>email:</strong> {$email}</p>
            <p><strong>message:</strong><br>{$message}</p>
        ";
        $mail->AltBody = "name: {$name}\n email: {$email}\n message:\n{$message}";

        // ارسال ایمیل
        $mail->send();
        $isSuccessful = true; // فرض می‌کنیم که ارسال موفقیت‌آمیز بوده است
        if ($isSuccessful) {
            // مخفی کردن پیام خطا و نمایش پیام موفقیت
            echo "OK"; // ارسال موفقیت‌آمیز
        } else {
            // در صورتی که پیام خطا باشد
            echo '<div class="error-message" style="color: white; background-color: red; padding: 10px; border-radius: 5px; text-align: center;">Error: Something went wrong.</div>';
        }
        
        
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
}
?>

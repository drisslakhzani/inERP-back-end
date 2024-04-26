<!DOCTYPE html>
<html>
<head>
    <title>Welcome to INERP Service</title>
</head>
<body>
<p>Dear {{ $emailData['firstName'] }},</p>

<p>Welcome to INERP Service! We are excited to have you on board.</p>

<p>You have chosen the following service: {{ $emailData['service'] }}.</p>

<p>Your generated access code is: {{ $emailData['generatedCode'] }}.</p>

<p>You can use this code to access your client space.</p>

<p>Thank you for choosing INERP Service.</p>

<p>Best regards,</p>
<p>The INERP Team</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Request</title>
</head>
<body>
<h2>Dear {{ $client->firstName }},</h2>
<p>Thank you for your request. Please find the details of your request attached in the PDF document.</p>
<p><a href="{{ $pdfUrl }}">Download PDF</a></p>
<p>Best Regards,<br>Your Company</p>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Request</title>
</head>
<body>
<h2>Hello Admin,</h2>
<p>A new request has been submitted. Below are the details:</p>
<p><strong>Client Name:</strong> {{ $client->firstName }}</p>
<p><strong>Company Name:</strong> {{ $client->companyName }}</p>
<p><strong>Email:</strong> {{ $client->email }}</p>
<p><strong>Phone Number:</strong> {{ $client->phoneNumber }}</p>
<p>Please find the request details attached in the PDF document.</p>
<p><a href="{{ $pdfUrl }}">Download PDF</a></p>
<p>Best Regards,<br>Your Company</p>
</body>
</html>

<!-- resources/views/emails/admin_notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Admin Notification</title>
</head>
<body>
<h2>Hello Admin,</h2>
<p>A new request has been submitted. Below are the details:</p>
<p><strong>Client Name:</strong> {{ $client->firstName }}</p>
<p><strong>Company Name:</strong> {{ $client->companyName }}</p>
<p><strong>Email:</strong> {{ $client->email }}</p>
<p><strong>Phone Number:</strong> {{ $client->phoneNumber }}</p>
<p>PDF Download Link: <a href="{{ url($pdfPath) }}">Download PDF</a></p>
</body>
</html>

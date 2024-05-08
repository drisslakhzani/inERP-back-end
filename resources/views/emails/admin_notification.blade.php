<!-- resources/views/emails/admin_notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Notification à l'administrateur</title>
</head>
<body>
<h2>Bonjour Administrateur,</h2>
<p>Une nouvelle demande a été soumise. Voici les détails :</p>
<p><strong>Nom du client :</strong> {{ $client->firstName }}</p>
<p><strong>Nom de l'entreprise :</strong> {{ $client->companyName }}</p>
<p><strong>Email :</strong> {{ $client->email }}</p>
<p><strong>Numéro de téléphone :</strong> {{ $client->phoneNumber }}</p>
<p>Lien de téléchargement du PDF : <a href="{{ url($pdfPath) }}">Télécharger le PDF</a></p>
</body>
</html>

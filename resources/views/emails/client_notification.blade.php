<!-- resources/views/emails/admin_notification.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Notification de demande</title>
</head>
<body>
<h2>Bonjour ,{{ $client->firstName }}</h2>
<p>Une nouvelle demande a été soumise. Voici les détails :</p>
<p><strong>Nom de l'entreprise :</strong> {{ $client->companyName }}</p>
<p><strong>Email :</strong> {{ $client->email }}</p>
<p><strong>Numéro de téléphone :</strong> {{ $client->phoneNumber }}</p>
<p>Lien de téléchargement de devis : <a href="{{ url($pdfPath) }}">Télécharger le PDF</a></p>
</body>
</html>

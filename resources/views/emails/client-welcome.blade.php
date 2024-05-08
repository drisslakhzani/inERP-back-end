<!DOCTYPE html>
<html>
<head>
    <title>Bienvenue chez INERP Service</title>
</head>
<style>
    .img-inerp{
        width: 20%;
    }
</style>
<body>
<img class="img-inerp" src="{{ asset('/assets/inerp_logo_origin.png') }}" alt="INERP Logo">
<p>Cher {{ $emailData['firstName'] }},</p>

<p>Bienvenue chez INERP Service ! Nous sommes ravis de vous accueillir.</p>



<p>Votre code d'accès généré est : <u>{{ $emailData['generatedCode'] }}</u>.</p>

<p>Vous pouvez utiliser ce code pour accéder à votre espace client avec votre nom.</p>

<p>Merci d'avoir choisi INERP Service.</p>

<p>Cordialement,</p>
<p>L'équipe INERP</p>
</body>
</html>

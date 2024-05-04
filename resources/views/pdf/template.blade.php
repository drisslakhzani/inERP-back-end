<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modèle PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* Utilisez une police de caractères de qualité comme Arial */
        }
        h1 {
            text-align: center; /* Centrer les en-têtes */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 0 auto; /* Centrer la table */
        }
        th.thisone, td.thisone {
            border: 1px solid #000; /* Ajouter des bordures aux cellules */
            padding: 8px; /* Ajouter du remplissage pour un meilleur espacement */
            text-align: center; /* Centrer le texte dans les cellules */
        }
        td.additionalOptions {
            text-align: left; /* Aligner le texte sur la gauche */
        }
    </style>
</head>
<body>

<h1>Détails du client :</h1>
<p>Nom du client : {{ $client->firstName }}</p>
<p>Nom de l'entreprise : {{ $client->companyName }}</p>

<h1>Demandes du client :</h1>
<table>
    <thead>
    <tr>
        <th class="thisone">Solution</th>
        <th class="thisone">Type de solution</th>
        <th class="thisone">Numéro</th>
        <th class="thisone">Options supplémentaires</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($requests as $request)
        @foreach ($request->selectedSolutions as $index => $selectedSolution)
            <tr>
                <td class="thisone">{{ $selectedSolution['solution'] }}</td>
                <td class="thisone">{{ $selectedSolution['solutionType'] }}</td>
                <td class="thisone">{{ $selectedSolution['number'] }}</td>
                <td class="thisone additionalOptions">
                    <ul>
                        @foreach ($selectedSolution['additionalOption'] ?? [] as $option)
                            <li>{{ $option }}</li>
                        @endforeach
                    </ul>
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</body>
</html>

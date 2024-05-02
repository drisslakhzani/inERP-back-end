<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Template</title>
</head>
<body>
<h1>Client Details:</h1>
<p>Client Name: {{ $client->firstName }}</p>
<p>Company Name: {{ $client->companyName }}</p>

<h1>Client Requests:</h1>
<table>
    <thead>
    <tr>
        <th>Description</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($requests as $request)
        <tr>
            <td>{{ $request->clientId }}</td>
            <td>{{ $request->solutionType }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

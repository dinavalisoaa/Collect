<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Transport Marchandise</title>
</head>

<body>
    <h2>Attribution transport marchandise</h2>
    <form action="/savetm" method="POST">
        @csrf
        <label for="societe">Planning Collecte :</label>
        <input type="date" name="datePlan" id="datePlan"><br><br>
        <label for="">Point de Collecte</label>
        <input type="text" id="pointCollecte" name="pointCollecte"><br><br>
        <label for="societe">Société :</label>
        <select id="transport" name="transport">
            @foreach ($transports as $transport)
                <option value="{{ $transport->id }}">{{ $transport->nom }}</option>
            @endforeach
        </select><br><br>
        <label for="capacite">Tonnage :</label>
        <input type="number" id="capacite" name="capacite"><br><br>

        <label for="marque">Remarque :</label>
        <textarea name="remarque" id="remarque" cols="30" rows="10"></textarea><br><br>


        <input type="submit" value="Soumettre">
    </form>
</body>

</html>

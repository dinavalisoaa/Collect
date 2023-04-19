@extends('side')
@section('content')
    <h2>Etat de stock {{ $produit->nom }}</h2>
    <table border="1" width="400">
        <tr>
            <th>Valeur en stock</th>
            <th>Quantite en stock</th>
        </tr>
        <tr>
            <td>{{ $etat->valeurstock }}</td>
            <td>{{ $etat->quantitestock }}</td>
        </tr>
    </table>
    <h4>{{ $produit->typestock->nom }} : reste en stock</h4>
    <table border="1" width="800">
        <tr>
            <th>Date</th>
            <th>Quantite</th>
            <th>Prix unitaire</th>
            <th>Valeur</th>
        </tr>
        @foreach ($produit->stocks as $stock)
            <tr>
                <td>{{ $stock->dateentree }}</td>
                <td>{{ $stock->quantite }}</td>
                <td>{{ $stock->formatPU() }}</td>
                <td>{{ $stock->formatTotal() }}</td>
            </tr>
        @endforeach
    </table>
@endsection

@extends('side')
@section('content')
    <h2>Produit a consulter</h2>
    <table border="1" width="400">
        <tr>
            <th>Produit</th>
            <th>Action</th>
        </tr>
        @foreach ($produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td><a href="/etatStock/{{ $produit->id }}"><button>Consulter</button></a></td>
            </tr>
        @endforeach
    </table>
@endsection

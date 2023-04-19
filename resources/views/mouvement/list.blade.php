@extends('side')
@section('content')
    <h2>Mouvements stock</h2>
    <form action="/filterMouvement" method="get">
        <select name="produit">
            <option value="">produit</option>
            @foreach ($produits as $produit)
                <option value="{{ $produit->id }}">{{ $produit->nom }}</option>
            @endforeach
        </select>
        <select name="engard">
            <option value="">engard</option>
            @foreach ($engards as $engard)
                <option value="{{ $engard->id }}">{{ $engard->nom }}</option>
            @endforeach
        </select>
        <input type="submit" value="Filtrer">
    </form>
    <table border="1" width="800">
        <tr>
            <th>Date</th>
            <th>Produit</th>
            <th>Quantite</th>
            <th>Prix Unitaire</th>
            <th>Action</th>
        </tr>
        @foreach ($mouvements as $mouvement)
            <tr>
                <td>{{ $mouvement->date }}</td>
                <td>{{ $mouvement->produit->nom }}</td>
                <td>{{ $mouvement->quantite }}</td>
                <td>{{ $mouvement->prixunitaire }}</td>
                <td>
                    <a href="/modifMouvement/{{ $mouvement->id }}"><button>Modifier</button></a>
                    <form action="/deleteMouvement/{{ $mouvement->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button>Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $mouvements->links() }}
@endsection

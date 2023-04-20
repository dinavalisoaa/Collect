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
    <div class="col-lg-12">

<div class="card">
    <div class="card-body">
    <table class="table" width="800">
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
                <td>
                @if($mouvement->quantite<0)
            <button class='btn btn-danger'>{{-1*$mouvement->quantite}}
                <i class="bi bi-box-arrow-in-down"></i></button>
                @else
            <button class='btn btn-success'>{{$mouvement->quantite}}

                <i class="bi bi-box-arrow-in-up"></i>
                @endif    
                </td>
                <td>{{ $mouvement->prixunitaire }}</td>
                <td>
                    <form action="/deleteMouvement/{{ $mouvement->id }}" method="post">
                        @csrf
                        @method('delete')
                        <a href="/modifMouvement/{{ $mouvement->id }}"><button type="button">Modifier</button></a>
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
    </div>
</div>
    {{ $mouvements->links() }}
@endsection

@extends('side')
@section('content')

<div class="row">
    <div class="col-lg-1 col-lg-8 col-lg-1">

        <div class="card">
            <div class="card-body">
                <h2>Produit a consulter</h2>
                <!-- <table class="table  table-striped datatable" width="500"> -->
                <h2>Etat de stock {{ $produit->nom }}</h2>

                <div class="card">
                    <div class="card-body">
                        <table class="table datatable" width="800">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantite</th>
                                    <th scope="col">Prix Unitaire</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mouvements as $mouvement)
                                <tr>
                                    <td>{{ $mouvement->date }}</td>
                                    <td>{{ $mouvement->produit->nom }}</td>
                                    <td>
                                        @if($mouvement->quantite<0) <button class='btn btn-danger'>{{-1*$mouvement->quantite}}
                                            <i class="bi bi-box-arrow-in-down"></i></button>
                                            @else
                                            <button class='btn btn-success'>{{$mouvement->quantite}}

                                                <i class="bi bi-box-arrow-in-up"></i>
                                                @endif
                                    </td>
                                    <td>{{ Util::format($mouvement->prixunitaire) }}Ar</td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                        <table class="table" width="400">
                            <tr>
                                <th></th>
                                <th>Valeur en stock</th>
                                <th>Quantite en stock</th>
                                <th>PU</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td>{{ Util::format($etat->valeurstock) }}Ar</td>
                               <td>
                                    <button class='btn btn-success'>{{ $etat->quantitestock }}</button>
                                </td>
                                <td>
                                    <button class='btn btn-success'>{{  Util::format($etat->valeurstock/$etat->quantitestock) }}Ar</button>
                                </td>
                            </tr>


                        </table>

                    </div>
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
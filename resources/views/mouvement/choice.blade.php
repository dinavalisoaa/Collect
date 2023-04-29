@extends('side')
@section('content')


<div class="row">
  <div class="col-lg-1 col-lg-8 col-lg-1">
 
    <div class="card">
      <div class="card-body">    
<h2>Produit a consulter</h2>
<table class="table  table-striped datatable" width="500">
        <tr>
            <th>Produit</th>
            <th>Action</th>
        </tr>
        @foreach ($produits as $produit)
            <tr>
                <td>{{ $produit->nom }}</td>
                <td><a href="/etatStock/{{ $produit->id }}" ><button class="btn btn-success">Consulter</button></a></td>
            </tr>
        @endforeach
    </table>
      </div>
    </div>
  </div>
@endsection

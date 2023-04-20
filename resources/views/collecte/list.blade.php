@extends('side')
@section('content')
<div class="pagetitle">
    <h1>Les collecteurs</h1>
    <nav>
        {{-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol> --}}
    </nav>
</div>


<div class="row">
    <div class="col-lg-1 col-lg-10 col-lg-1">
<?php $total=0;?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Les Collecteurs</h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">PU</th>
                            <th scope="col">Qte</th>
                            <th scope="col">montant</th>
                            <th scope="col">Date</th>
                            <th scope="col">Collecteur</th>

                        </tr>
                    </thead>
                    <tbody>
                        <!-- id | quantite |    date    | prixunitaire | produitid | pointcollectid | collecteurid | planningcollecteid -->
                        @foreach ($list as $row)
                        <tr>

                            <td>{{ $row->getProduit()->nom }}</td>
                            <td>{{ $row->prixunitaire }} MGA</td>
                            <td>{{ $row->quantite }}</td>
                            <td>{{ $row->quantite*$row->prixunitaire }}MGA</td>
                            <?php $totald=$row->quantite*$row->prixunitaire;
                            $total+=$totald;?>
                            <td> {{ date('j F Y', strtotime($row->date)) }}
                            <td><a href="">{{ $row->getCollecteur()->nom }}</a></td>

                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th></th>
                        <th></th>
                        <th>TOTAL</th>
                        <th  style="color:red">{{$total}} MGA</th>
                    </tr>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </div>
</div>
@endsection
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
        <?php $total = 0; ?>
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
                            <?php $totald = $row->quantite * $row->prixunitaire;
                            $total += $totald; ?>
                            <td> {{ date('j F Y', strtotime($row->date)) }}
                            <td><a href="">{{ $row->getCollecteur()->nom }}</a></td>
                            <td>
                                @if($row->etat==0)
                               <a href="/insertEntree?pu={{ $row->prixunitaire }}&produit={{ $row->produitid }}&quantite={{$row->quantite}}&date"> <button class='btn btn-warning'>Enregistrer</button></a>
                               <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                Launch Modal
              </button>
              <div class="modal fade"  id="basicModal"  tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Disabled Backdrop</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Non omnis incidunt qui sed occaecati magni asperiores est mollitia. Soluta at et reprehenderit. Placeat autem numquam et fuga numquam. Tempora in facere consequatur sit dolor ipsum. Consequatur nemo amet incidunt est facilis. Dolorem neque recusandae quo sit molestias sint dignissimos.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div><!-- End Disabled Backdrop Modal-->

            </div>
          </div>
                                @else
                                <button class='btn btn-warning' disabled>ok</button>

                                @endif

                            </td>

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
                        <th style="color:red">{{$total}} MGA</th>
                    </tr>
                </table>
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </div>
</div>
@endsection
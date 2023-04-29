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
        <!-- <a href="/collecte/list?tous=true">
      <button class='btn btn-info'>all collecte</button>
    </a> -->
        <a href="/collecte/list?planning={{$plan}}&etat=0">
          <button class='btn btn-danger'>
            <i class="ri-close-circle-line
"></i>Non Enregistrer
          </button>
        </a> <a href="/collecte/list?planning={{$plan}}&etat=1">
          <button class='btn btn-primary'>
            <i class="bi bi-check"></i> Enregistrer
          </button>
        </a>
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">Produit</th>
              <th scope="col">PU</th>
              <th scope="col">Qte</th>
              <th scope="col">montant</th>
              <th scope="col">Date</th>
              <th scope="col">Collecteur</th>
              <th scope="col">Enregistrement</th>

            </tr>
          </thead>
          <tbody>
            @foreach ($list as $row)
            <tr>
              <td>
                <a href="/etatStock/{{$row->getProduit()->id }}"> {{$row->getProduit()->nom }}</a>
              </td>
              <td>{{Util::format($row->prixunitaire) }} Ar</td>
              <td>{{ $row->quantite }}</td>
              <td>{{ Util::format($row->quantite*$row->prixunitaire) }}Ar</td>
              <?php $totald = $row->quantite * $row->prixunitaire;
              $total += $totald; ?>
              <td> {{ date('j F Y', strtotime($row->date)) }}
              <td><a href="">{{ $row->getCollecteur()->nom }}</a></td>
              <td>
                @if($row->etat==0)
                <a href="/insertEntree?pu={{ $row->prixunitaire }}&produit={{ $row->produitid }}&quantite={{$row->quantite}}&date={{ date('Y-m-j', strtotime('today')) }}&engard={{1}}&id={{$row->id}}&planning={{$row->getPlanningCollecte()->id}}
                "> <button class='btn btn-danger'>
                    <i class="ri-close-circle-line">Enregistrer</i></button></a>
                @else
                <button class='btn btn-success' disabled>
                  <i class="ri-checkbox-circle-line"></i>
                </button>

                @endif

              </td>
              <td>
            
            </tr>
            @endforeach

          </tbody>
        </table>  
        <table class="table table-bordered">
          <tr>
            <th></th>
            <th></th>
            <th>TOTAL</th>
            <th style="color:red">{{ Util::format($total)}} Ar</th>
          </tr>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>
@endsection
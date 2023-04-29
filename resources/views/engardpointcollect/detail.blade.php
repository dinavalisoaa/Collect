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
  <a class="btn btn-primary" href="/e-pointcollect/add">
                        Ajouter Engard
                    </a>
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Points de collect a proximite</h5>
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">Produit</th>
            </tr>
          </thead>
          <tbody>
            <!-- id | quantite |    date    | prixunitaire | produitid | pointcollectid | collecteurid | planningcollecteid -->
            @foreach ($list as $row)
            <tr>

              <td>{{ $row->getPointCollecte()->nom }} </td>
              <td>{{ $row->quantite }}</td>

              <td>

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
          </tr>
        </table>
        <!-- End Table with stripped rows -->

      </div>
    </div>

  </div>
</div>
@endsection
@extends('side')
@section('content')
    <div class="pagetitle">
        <h1>Planning Collect</h1>
        <nav>
            {{-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol> --}}
        </nav>
    </div>


    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Planning Collect</h5>
                    <a class="btn btn-primary" href="/planningcollect/add">
                        Ajouter Planning
                    </a>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Nom du produit</th>
                                <th scope="col">Tonnage</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Delai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $row)
                                <tr>
                                    <td>{{ $row->getProduit()->nom }}</td>
                                    <td>{{ $row->tonnage }}T</td>

                                    <td>{{ $row->budget }}Ar</td>
                                    <td>{{ $row->datedelai }}</td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <!-- End Table with stripped rows -->

                </div>
            </div>

        </div>
    </div>
@endsection

@extends('side')
@section('content')
    <div class="pagetitle">
        <h1>Engard de Collect</h1>
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
                    <h5 class="card-title">Engard de Collect</h5>
                    <a class="btn btn-primary" href="/engard/add">
                        Ajouter Engard
                    </a>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Nom du Engard</th>
                                <th scope="col">Region</th>
                                <th scope="col">Latitude</th>
                                <th scope="col">Longitude</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $row)
                                <tr>
                                    <td>{{ $row->nom }}</td>
                                    <td>{{ $row->getRegion()->nom }}T</td>

                                    <td>{{ $row->latitude }}Ar</td>
                                    <td>{{ $row->longitude }}</td>

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

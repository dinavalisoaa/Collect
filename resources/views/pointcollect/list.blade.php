@extends('side')
@section('content')
    <div class="pagetitle">
        <h1>Point de Collect</h1>
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
                    <h5 class="card-title">Point de Collect</h5>
                    <a class="btn btn-primary" href="/pointcollect/add">
                        Ajouter Point
                    </a>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">Nom du Point</th>
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

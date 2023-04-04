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
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Les Collecteurs</h5>
                    <a class="btn btn-primary" href="/collecteur/add">
                        Ajouter Collecteur
                    </a>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach ($list as $row) --}}
                                <tr>

                                    <th scope="row">
                                        {{-- <img src="/{{ $row->photo }}" width="30px" height="60px"> --}}
                                    </th>
                                    {{-- <td>{{ $row->nom }}</td> --}}

                                    {{-- <td>{{ $row->login }}</td> --}}
                                    {{-- <td>{{ $row->contact }}</td> --}}

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

@extends('side')
@section('content')
    <div class="pagetitle">
        <h1>Produit</h1>
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
                    <h5 class="card-title">Produit</h5>
                    <a class="btn btn-primary" href="/produit/add">
                        Ajouter Produit
                    </a>
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Type</th>
                                <th scope="col">Saison</th>
                                <th scope="col">Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($list as $row)
                                <tr>

                                    <th scope="row">
                                        {{ $row->id }}
                                    </th>
                                    <td>
                                        {{ $row->nom }}
                                    </td>


                                    <td>
                                        {{ $row->getTypeProduit()->nom }}
                                    </td>
                                    <td>
                                        <p>
                                            {{ $row->getSaison()->nom }}
                                        </p>
                                        <p>
                                            {{ $row->getSaison()->moisdebut }}
                                            >>
                                            {{ $row->getSaison()->moisfin }}
                                        </p>
                                    </td>

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

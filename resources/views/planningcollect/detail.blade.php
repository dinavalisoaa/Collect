@extends('side')
@section('content')
<div class="pagetitle">
    <h1>Planning Collect</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin/dash">Retour</a></li>
        </ol>
    </nav>
</div>


<div class="row">
    <div class="col-lg-1">
    </div>
    <div class="col-lg-9">

        <div class="col-md-9">
            <table class="table table-bordered">
                <tr>
                    <td>POINT</td>
                    <td>BUDGET</td>
                    <td>Dead line</td>
                </tr>
                <form action="/planningcollect/action_add" method="GET">
                    <!-- @csrf   -->
                    <tr>
                        <td>
                            <!-- <div class="row mb-3"> -->
                            <!-- <div class="col-sm-10"> -->
                            <select class="form-select" name="produit" aria-label="Default select example">
                                @foreach ($produit as $row)
                                <option value="{{$row->id}}">{{$row->nom}}</option>
                                @endforeach
                            </select>
                            <!-- </div> -->
                            <!-- </div> -->
                        </td>


                        <td>
                            <div class="col-sm-10">
                                <input type="text" name="budget" class="form-control" placeholder="AR">
                            </div>
                        </td>
                        <td>
                            <div class="col-sm-10">
                                <input type="text" value="<?php echo Util::date($dates) ?>" class="form-control" disabled>

                                <input type="hidden" value=<?php echo  $dates ?> name="datedelai" class="form-control">

                            </div>
                        </td>
                        <td>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Ajouter</button>
                            </div>
                        </td>
        </div>

        </tr>


        </form>
        </table>
        <!-- End General Form Elements -->
    </div>
    <!-- </div> -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Planning Collect</h5>
            <h2>Date:{{
               date('j F Y',strtotime($dates))
            }}</h2>
            <table class="table datatable">
                <thead>
                    <tr>
                        <th scope="col">Point Collect</th>
                        <th scope="col">Budget</th>
                        <th scope="col">Reste</th>
                        <th scope="col">Delai</th>
                        <th scope="col">Etat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($list as $row)
                    <tr>
                        <td>{{ $row->getPointCollecte()->nom }}</td>
                        <td>{{ Util::format($row->budget) }}Ar</td>
                        <td>{{ Util::format($row->getEtatBudget()) }}Ar</td>

                        <td>
                            <button class='btn btn-success'>
                                {{ date('j F Y', strtotime($row->datedelai)) }}
                            </button>
                        </td>
                        <td>
                            <a href="/collecte/list?planning={{ $row->id}}">

                                <button class="btn btn-danger">
                                    <i class="bi bi-box-arrow-in-down"></i>
                                    {{$row->counts()}} collectés
                                </button>
                            </a>
                        </td>

                        <td>
                            <a href="/charge/list?id={{ $row->id}}">
                                <button class="btn btn-light">
                                    <i class="ri-table-fill"></i>
                                    Charge
                                </button> </a>
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
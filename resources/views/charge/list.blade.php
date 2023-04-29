@extends('side')
@section('content')
<div class="pagetitle">
    <h1>Engard de Collect</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol> 
        <?php 
        $to=0;
        ?>
    </nav>
</div>
<div class="row">
    <div class="col-lg-12">
    <div class='card'  width="420px">
        <div class="card-body">
            
    </div>
        <div class="card">
           
                 <div class="card-body">
                <h2 class="card-title">Dépenses</h2>
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Point de Collecte</th>
                        <th scope="col">Budget</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>
                    {{$collecte->getPointCollecte()->nom}}

                    </td>
                        <td>{{Util::format($collecte->budget)}}Ar</td>
                    </tr>
                </tbody>
       
            </table>
                <h2 style="text-align:center">
                </h2>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th scope="col">Designation</th>
                            <th scope="col">montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($list as $row)
                        <tr>
                            <td>{{ $row->getType()->nom }}</td>
                            <td>{{ Util::format($row->montant) }}Ar</td>
                            <?php 
                            $to+=$row->montant;
                            ?>
                        </tr>
                        @endforeach
                        <tr style="background-color:rgba(220, 220, 220, 0.829);border-style:solid">
                            <td>
                                Total
                            </td>
                            <td style="color:red;">{{ Util::format($to) }}Ar</td>
                        </tr>
                      
                    </tbody>
                </table>
                
                <!-- End Table with stripped rows -->

            </div>
        </div>

    </div>
</div>
@endsection
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
        <h5 class="card-title">Les Collecteurs</h5>
        <table class="table datatable">
          <thead>
            <tr>
              <th scope="col">Engard</th>
              <th scope="col">Point de collect a proximite</th>
          <tbody>
            <!-- id | quantite |    date    | prixunitaire | produitid | pointcollectid | collecteurid | planningcollecteid -->
            @foreach ($list as $row)
            <tr>

              <td>
                {{ $row->nom
                }}
              </td>
              <td>
                {{
                  $row->getPointCollectes()[0]->getPointCollecte()->nom
                 }}
                <a href="detail?pt={{ $row->id }}">
                  <button class="btn btn-info">
                    {{ count($row->getPointCollectes())-1 }}+ autres
                  </button>

                </a>

              </td>
              <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal{{$row->id}}">
                  Ajout
                </button>
              </td>
              </td>

            </tr>
            @endforeach

          </tbody>
        </table>
        @foreach($list as $row)
        <div style="height:800px" class="modal fade" id="basicModal{{$row->id}}" tabindex="-1">
          <!-- <div class="modal-dialog"> -->
          <!-- <div class="modal-dialog modal-dialog-scrollable"> -->
          <div class="modal-dialog modal-lg" style="height:800px">

            <div class="modal-content" style="height:500px">
              <div class="modal-header">
                <h5 class="modal-title">Disabled Backdrop</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="action_add" method="GET">
                 <input type="hidden" value="{{$row->id}}" name="id"/>
                  <select style="height:270px"class="form-select" name="pts" multiple aria-label="multiple select example">
                    <option selected>Open this select menu</option>
                    @foreach( $row->getPointCollectNonLier() as $rows)
                    <option value="{{
                           $rows->id
                          }}"> {{
                           $rows->nom 
                          }}</option>
                    @endforeach

                  </select>
                  </select>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            </form>

          </div>
        </div>
        @endforeach
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
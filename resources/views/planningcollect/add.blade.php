@extends("side")
@section("content")

 <div class="pagetitle">
      <h1>Ajout Collecteur</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/planningcollect/list">Collecteur list</a></li>
          {{-- <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li> --}}
        </ol>
      </nav>
    </div>
<div class="row">
        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">General Form Elements</h5>

              <!-- General Form Elements -->
              <form action="/planningcollect/action_add"method="GET">>
                @csrf
                   <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Produit</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="produit" aria-label="Default select example">
                        @foreach ($produit as $row)
                        <option value="{{$row->id}}">{{$row->nom}}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tonnage Estime</label>
                  <div class="col-sm-10">
                    <input type="text"name="tonnage"class="form-control">
                  </div>
                </div>
                   <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Budget de depart</label>
                  <div class="col-sm-10">
                    <input type="text"name="budget" class="form-control">
                  </div>
                </div>
                       <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Delai</label>
                  <div class="col-sm-10">
                    <input type="date"name="datedelai" class="form-control">
                  </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit Button</label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

        <div class="col-lg-2">



        </div>
      </div>

@endsection

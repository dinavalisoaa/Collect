@extends('side')
@section('content')
<link href="/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
<link href="/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
<link href="/assets/vendor/quill/quill.snow.css" rel="stylesheet">
<link href="/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
<link href="/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
<link href="/assets/vendor/simple-datatables/style.css" rel="stylesheet">
<!-- Template Main CSS File -->
<link href="/assets/css/style.css" rel="stylesheet">

<div class="pagetitle">
  <h1>Les collecteurs</h1>
  <nav>
    {{-- <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol> --}}
  </nav>
</div>
<!-- <main id="main" class="main">   -->
<section class="section">
  <div class="row align-items-top">
    @foreach ($list as $row)

    <div class="col-lg-3">

      <!-- Card with an image overlay -->

      <div class="card text-center">
        <div class="card-header">
          <img src="/{{ $row->photo }}" class="img" width="30px" height="60px">

        </div>
        <div class="card-body">
          <h5 class="card-title">Special title treatment</h5>
          <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div><!-- End Special title treatmen -->

    </div>
    @endforeach
  </div>
</section>
<section class="section contact">
  <div class="row gy-4">

    <div class="col-xl-12">

      <div class="row">
        @foreach ($list as $row)

        <div class="col-lg-4">
          <div class="info-box card">
            <img src="/{{ $row->photo }}" width="30px" height="60px">

            <h3>{{$row->nom}}</h3>
            <p>
              <span>
                <i style="height:4px;" class="bi bi-telephone"></i>

              </span>
              {{$row->contact}}
            </p>
            <p>
              <i class="bi bi-envelope"></i>{{$row->login}}
            </p>
          </div>
        </div>

        @endforeach
      </div>

    </div>
  </div>
  <!-- 
</section>

</main> -->

  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Les Collecteurs</h5>
          <a class="btn btn-primary" href="//collecteur/add">
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
              @foreach ($list as $row)
              <tr>

                <th scope="row">
                  <img src="/{{ $row->photo }}" width="30px" height="60px">
                </th>
                <td>{{ $row->nom }}</td>

                <td>{{ $row->login }}</td>
                <td>{{ $row->contact }}</td>

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
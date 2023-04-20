@extends('side')
@section('content')
<section class="section">
  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-12">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <style>
                #c1:hover {
                  margin-top: -10px;
                  width: 280px;
                  transition-duration: 2.2s;
                  transform-box: view-box;
                  box-shadow:7px 0 30px rgba(92, 141, 212, 0.1);
 animation: float 3s ease-out infinite;

                }
                #c1 {
}

@keyframes float {
  50% {
     transform: translate(0, 20px);
  }
}
.shadowFrame {
  width: 130px;
  margin-top: 15px;
}
.shadow {
  animation: shrink 3s ease-out infinite;
  transform-origin: center center;
  ellipse {
    transform-origin: center center;
  }
}

@keyframes shrink {
  0% {
    width: 90%;
    margin: 0 5%;
  }
  50% {
    width: 60%;
    margin: 0 18%;
  }
  100% {
    width: 90%;
    margin: 0 5%;
  }
}
              </style>
              <div class="card-body">
                <h5 class="card-title">Recette</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-exchange"></i>
                  </div>
                  <div class="ps-3">
                    <!-- <h6>145</h6> -->
                    <h6><?php echo $somme_recette; ?> Ar</h6>
                    

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="card-body">
                <h5 class="card-title">Dépense</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-bar-chart-line"></i>
                  </div>
                  <div class="ps-3">
                  <h6><?php echo $somme_depense; ?> Ar</h6>
                  <!-- <h6>145</h6> -->

                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">

              

              <div class="card-body">
              <h5 class="card-title">Bénéfice</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                  </div>
                  <div class="ps-3">
                  <h6><?php echo $somme_benefice; ?> Ar</h6>


                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->
          <style>
            .box1 {
              display: grid;
              gap: 10px;
              /* grid-column: 1 / 2; */
              /*grid-row: 2;
               */
              /* flex-direction: column; */
               grid-template-columns: 3fr 3fr 1fr;
            }
          </style>
          <div class="row" >
            <div class="col-md-5" d="k2">

              <div class="box1">
                <a href="/admin/dash">

                  <div class="card" id="c1">
                    <div class="card-body">
                      <h2 class=  "card-title">Suivi des collections</h2>
                      <img src="/assets/img/collect.svg" />
                    </div>


                  </div>
                </a>
                <a href="/listMouvement">

                  <div class="card" id="c1">
                    <div class="card-body">
                    <h2 class="card-title">Stock</h2>
                    <img src="/assets/img/stock1.svg" />

                    </div>


                  </div>
                </a>
                </div>
                <div class="box1">
                <a href="#">

                  <div class="card" id="c1">
                    <div class="card-body">
                   
                    <h2 class="card-title">Vente</h2>
                      <img src="/assets/img/vente1.svg" /> 
                    </div>

                  </div>
                </a>
                <!-- </div> -->
                <!-- <div class="box1"> -->
                <!-- <a href="#"> -->
                <a href="/statistique/all">
                  <!-- <button class="btn btn-danger">Plus de Statistiques</button> -->

                  <!-- </a> -->
                  <div class="card" id="c1">
                    <div class="card-body"><h2 class="card-title">Statistiques</h2>
                    <img src="/assets/img/stat1.svg" />

                    </div>

                  </div>
                </a>
              </div>
            </div>
            <div class="col-md-7">
              
             
              <div class="card">
                                <div class="card-body">
                                <h5 class="card-title">Recette, dépense, bénéfice de l'année</h5>
                                    <!-- Line Chart -->
                                     <h5>       
            
                  </h5>
                                <div id="reportsChart"></div>
                                <script>
                                    document.addEventListener("DOMContentLoaded", () => {
                                    new ApexCharts(document.querySelector("#reportsChart"), {
                                        series: [{
                                        name: 'Recette',
                                        data: [
                                            @foreach ($recette as $row)
                                                {{ $row->montant }},
                                            @endforeach
                                        ]
                                        }, {
                                        name: 'Dépense',
                                        data: [
                                            @foreach ($depense as $row)
                                                {{ $row->montant }},
                                            @endforeach
                                        ]
                                        }, {
                                        name: 'Bénéfice',
                                        data: [
                                            @foreach ($benefice as $row)
                                                {{ $row->montant }},
                                            @endforeach
                                        ]
                                        }, {
                                        }],
                                        chart: {
                                        height: 350,
                                        type: 'area',
                                        toolbar: {
                                            show: false
                                        },
                                        },
                                        markers: {
                                        size: 4
                                        },
                                        colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                        fill: {
                                        type: "gradient",
                                        gradient: {
                                            shadeIntensity: 1,
                                            opacityFrom: 0.3,
                                            opacityTo: 0.4,
                                            stops: [0, 90, 100]
                                        }
                                        },
                                        dataLabels: {
                                        enabled: false
                                        },
                                        stroke: {
                                        curve: 'smooth',
                                        width: 2
                                        },
                                        xaxis: {
                                        type: 'text',
                                        categories: [
                                            @foreach ($mois as $row)
                                                '{{ $row->abreviation }}',
                                            @endforeach
                                        ]
                                        }
                                    }).render();
                                    });
                                </script>
                                <!-- End Line Chart -->

                                </div>

                            </div>
            </div>

          </div>
          <div class="col-1">
          </div>

        </div>
      </div><!-- End Left side columns -->


  </section>
  @endsection
@extends('backOffice.layout')

@section('head')

@include('backOffice.inc/head')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">

@endsection

@section('header')

@include('backOffice.inc/header')


@endsection


@section('aside')
    @include('backOffice.inc/aside', ["route"=>"reservation"])
@endsection


  @section('content')

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Blank Page</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>


    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

           <!-- /.card-header -->

              <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Liste des emprunts</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>N° Livre</th>
                        <th>Nom Client</th>
                        <th>N° Chambre</th>
                        <th>Date sorite</th>
                        <th>Date rendue</th>

                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($reservation as $reservation)
                      <tr>
                        <td>{{$reservation->start_date}}</td>
                        <td>{{$reservation->end_date}}</td>
                        <td>{{count(json_decode($reservation->chambres))}} Chambre(s) <span data-target="#modal-lg-{{$reservation->id}}" data-toggle="modal">Voir plus</span></td>
                        <td>{{$reservation->nom_client}}</td>
                        <td>{{$reservation->email_client}}</td>

                     {{--    <td><a data-target="#modal-lg-{{$reservation->id}}" data-toggle="modal">Confirme</a></td> --}}
{{-- //// Modal --}}

<div class="modal fade" id="modal-lg-{{$reservation->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
        <h4 class="modal-title">Reservation #{{$reservation->id}}   @switch($reservation->arrangment)
            @case(1)
                DP
                @break
            @case(2)
                PC
                @break
            @default
                All in
        @endswitch</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-3">
                    Chambres
                </div>
                <div class="col-md-3">
                    Adulte
                </div>
                <div class="col-md-3">
                   Enfant
                </div>
                <div class="col-md-3">
                    Bebe
                </div>
            </div>

            @foreach (json_decode($reservation->chambres) as $chambre)
            <div class="row">
                <div class="col-md-3">
                    {{$loop->index+1}}
                </div>
                <div class="col-md-3">
                    {{$chambre->adulte}}
                </div>
                <div class="col-md-3">
                    {{$chambre->enfant}}
                </div>
                <div class="col-md-3">
                    {{$chambre->bebe}}
                </div>
            </div>
            @endforeach
            <div class="row">
                <h3>Cause de refus si ce le cas</h3>

        </div>
        <form method="POST" action="{{ route('handleConfirmeReservation', ['id'=>$reservation->id]) }}">
            {{ csrf_field() }}
        <div class="row">
            <textarea name="cause" id="" cols="30" rows="10"></textarea>
        </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Envoyer</button>

            </div>

            </form>
  </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>N° Livre</th>
                        <th>Nom Client</th>
                        <th>N° Chambre</th>
                        <th>Date sorite</th>
                        <th>Date rendue</th>

                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
            <!-- /.card -->



              </form>
           </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


            <!-- /.card-header -->

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->

    @endsection


    @section('scripts')
    @include('backOffice.inc/scripts')

    <script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>


    @endsection

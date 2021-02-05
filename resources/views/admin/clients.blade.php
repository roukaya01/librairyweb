@extends('backOffice.layout')

@section('head')

@include('backOffice.inc/head')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('plugins') }}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('plugins') }}/toastr/toastr.min.css">
@endsection

@section('header')

@include('backOffice.inc/header')


@endsection


@section('aside')
    @include('backOffice.inc/aside', ["route"=>"rooms"])
@endsection


  @section('content')
  <style>
    .preview-images-zone {
        width: 100%;
        border: 1px solid #ddd;
        min-height: 180px;
        /* display: flex; */
        padding: 5px 5px 0px 5px;
        position: relative;
        overflow: auto;
    }

    .preview-images-zone>.preview-image:first-child {
        height: 185px;
        width: 185px;
        position: relative;
        margin-right: 5px;
    }

    .preview-images-zone>.preview-image {
        height: 90px;
        width: 90px;
        position: relative;
        margin-right: 5px;
        float: left;
        margin-bottom: 5px;
    }

    .preview-images-zone>.preview-image>.image-zone {
        width: 100%;
        height: 100%;
    }

    .preview-images-zone>.preview-image>.image-zone>img {
        width: 100%;
        height: 100%;
    }

    .preview-images-zone>.preview-image>.tools-edit-image {
        position: absolute;
        z-index: 100;
        color: #fff;
        bottom: 0;
        width: 100%;
        text-align: center;
        margin-bottom: 10px;
        display: none;
    }

    .preview-images-zone>.preview-image>.image-cancel {
        font-size: 18px;
        position: absolute;
        top: 0;
        right: 0;
        font-weight: bold;
        margin-right: 10px;
        cursor: pointer;
        display: none;
        z-index: 100;
    }

    .preview-image:hover>.image-zone {
        cursor: move;
        opacity: .5;
    }

    .preview-image:hover>.tools-edit-image,
    .preview-image:hover>.image-cancel {
        display: block;
    }

    .ui-sortable-helper {
        width: 90px !important;
        height: 90px !important;
    }

    .container {
        padding-top: 50px;
        padding-bottom: 50px;
    }

</style>


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
                    <h3 class="card-title">Liste de clients</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>N° Chambre</th>
                        <th>N° Livre</th>
                        <th>Nom Client</th>
                        <th>N° Téléphone</th>

                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($clients as $client)
                      <tr>
                        <td>{{$client->numchambre}}</td>
                        <td>{{$client->numlivre}}</td>
                        <td>{{$client->nom}}</td>
                        <td>{{$client->numtel}}</td>
                        <td>
                            <a href="{{ route('destroyclt',$client->id) }}"
                                class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;"
                                id="deleteCompany" data-id="{{ $client->id }}">
                                Delete
                            </a>
                            <a href="{{ route('showAdminClients', ['id'=> $client->id]) }}"
                                class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">
                                Update
                            </a>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>N° Chambre</th>
                        <th>N° Livre</th>
                        <th>Nom Client</th>
                        <th>N° Téléphone</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
            <!-- /.card -->
            <div class="card">
                @if($oldclient)

                       <div class="card-header"><h3 class="card-title mb-3">Modifier client {{$oldclient->numchambre}}</h3>
                <form method="POST" class="room-form" action="{{ route('editclt',['id'=>$oldclient->id]) }}"
                    enctype="multipart/form-data"></div>

                    @else
                    <div class="card-header"> <h3 class="card-title mb-3">Ajouter un nouveau client</h3>
                    <form method="POST" class="room-form" action={{ route('handleAddClient') }}
                        enctype="multipart/form-data"></div>

                        @endif
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                            <div class="row">
                                @if (count($errors) > 0)
                                <!-- Form Error List -->
                                <div class="alert alert-danger">
                                    <strong>Whoops! Something went wrong!</strong>

                                    <br><br>

                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                            </div>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">N° Chambre</label>
                                        <input type="number" name="numchambre"
                                            value="@isset($oldclient){{$oldclient->numchambre}}@endisset" class="form-control"
                                            id="exampleInputEmail1">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">N° Livre</label>
                                        <input type="number" name="numlivre"
                                            value="@isset($oldclient){{$oldclient->numlivre}}@endisset" class="form-control"
                                            id="exampleInputEmail1">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Nom Client</label>
                                        <input class="form-control" id="exampleInputPassword1"
                                            value="@isset($oldclient){{$oldclient->nom}}@endisset" name="nom"
                                            type="text"  placeholder="tapez nom client">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">N° Téléphone</label>
                                        <input class="form-control" id="exampleInputPassword1"
                                            value="@isset($oldclient){{$oldclient->numtel}}@endisset" name="numtel"
                                            type="number" step="any" placeholder="tapez le numéro téléphone">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <button class="btn btn-primary float-right" type="submit">
                                    @isset($oldroom)
                                    Modifier coordonnées client
                                    @else
                                    Ajouter client
                                    @endisset
                                </button>
                            </div>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/toastr/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
    <script>
        $(function () {

                    $("body").on("click", ".image-cancel", function () {
                        var route = $(this).data("route");
                        var no = $(this).data("id");
                        Swal.fire({
                            text: "supprimer cette photo ?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "oui"
                        }).then(result => {
                            if (result.value) {
                                $.ajax({
                                    method: "GET",
                                    url: route,
                                    success: function (data) {
                                        if (data['message'] === "success") {
                                            toastr.success("Photo supprimeé", {
                                                timeOut: 5000
                                            });
                                            $(".preview-image.preview-show-" + no).remove();
                                        } else {
                                            toastr.error(data['data'], {
                                                timeOut: 5000
                                            });
                                        }
                                    }
                                });
                            }
                        });
                    });
        })

    </script>
    <script>
        $(function () {
            $(".chosen-select").chosen({
                no_results_text: "Oops, nothing found!"
            });
        })

    </script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });

    </script>
    @isset($oldroom)
    <script>
        $(function () {

            var values = {!!($oldroom->commoditie)!!};
            var str_array = values;
            $("#commodity").val(str_array).trigger("chosen:updated");

        });


    </script>
    @endisset
    <script>
        $(function () {

            @if(count($errors) > 0)
            @foreach($errors->all() as $error)

            Toast.fire({
                icon: 'error',
                title: '{{ $error }}'
            })
            @endforeach
            @endif
        })

        $(document).ready(function () {

            $("body").on("click", "#deleteCompany", function (e) {

                if (!confirm("Do you really want to do this?")) {
                    return false;
                }

                e.preventDefault();
                var id = $(this).data("id");
                // var id = $(this).attr('data-id');
                var token = "{{ csrf_token() }}";
                var url = e.target;

                $.ajax({
                    url: url.href, //or you can use url: "company/"+id,
                    type: 'GET',
                    data: {
                        _token: token,
                        id: id
                    },

                    success: function (response) {


                        $("#example1").DataTable()
                            .row($(".row" + id))
                            .remove()
                            .draw();

                        $("#success").html(response.message)

                        Swal.fire(
                            'Remind!',
                            'Company deleted successfully!',
                            'success'
                        )
                    }
                });
                return false;
            });


        });

    </script>
    @endsection

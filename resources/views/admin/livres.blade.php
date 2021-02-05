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
                    <h3 class="card-title">Liste de livres</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>N° livre</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Auteur</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach ($livres as $livre)
                      <tr>
                        <td>{{$livre->numero}}</td>
                        <td>{{$livre->titre}}</td>
                        <td>{{$livre->categorie}}</td>
                        <td>{{$livre->auteur}}</td>
                        <td>{{$livre->date}}</td>
                        <td>
                            <a href="{{ route('destroy', $livre->id) }}"
                                class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;"
                                id="deleteCompany" data-id="{{ $livre->id }}">
                                Delete
                            </a>
                            <a href="{{ route('showAdminLivres', ['id'=> $livre->id]) }}"
                                class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;">
                                Update
                            </a>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>N° livre</th>
                        <th>Titre</th>
                        <th>Catégorie</th>
                        <th>Auteur</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
            <!-- /.card -->
            <div class="card">
                @if($oldlivre)

                       <div class="card-header"><h3 class="card-title mb-3">Modifier le livre {{$oldlivre->numero}}</h3>
                <form method="POST" class="room-form" action="{{ route('edit',['id'=>$oldlivre->id]) }}"
                    enctype="multipart/form-data"></div>

                    @else
                    <div class="card-header"> <h3 class="card-title mb-3">Ajouter un nouveau livre</h3>
                    <form method="POST" class="room-form" action={{ route('handleAddLivre') }}
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
                                        <label for="exampleInputEmail1">N° livre</label>
                                        <input type="number" name="numero"
                                            value="@isset($oldlivre){{$oldlivre->numero}}@endisset" class="form-control"
                                            id="exampleInputEmail1">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Titre</label>
                                        <input class="form-control" type="text"
                                            value="@isset($oldlivre){{$oldlivre->titre}}@endisset" name="titre"
                                            {{ old('titre') }} id="exampleInputPassword1" placeholder="taper le titre">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Catégorie</label>
                                        <input class="form-control" id="exampleInputEmail1"
                                            value="@isset($oldlivre){{$oldlivre->categorie}}@endisset" type="text"
                                            name="categorie" placeholder="entrer la catégorie">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Auteur</label>
                                        <input class="form-control" id="exampleInputPassword1"
                                            value="@isset($oldlivre){{$oldlivre->auteur}}@endisset" name="auteur"
                                            type="text" step="any" placeholder="tapez le nom d'auteur">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="credit1">Résumé</label>
                                    <textarea name="resume" id="" style="width: 100%" cols="30"
                                        rows="10">   @isset($oldlivre) {!! nl2br($oldlivre->resume) !!}@endisset</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 form-group mb-3">
                                    <label for="website">image</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="photos[]" multiple class="custom-file-input"
                                                id="inputGroupFile02" accept=".pdf,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" for="inputGroupFile02"
                                                aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @isset($oldlivre)
                            <div class="container">
                                <fieldset>
                                    Livre existe
                                </fieldset>
                                <div class="preview-images-zone">
                                    @if (!empty($oldlivre->media))
                                      @foreach ($oldlivre->media as $media)

                                    <div class="preview-image preview-show-{{$media->id}}">
                                        <div class="image-cancel" data-id="{{$media->id}}"
                                        data-route="{{ route('DeleteLivreMedia', ['id'=>$media->id]) }}">x</div>
                                        <div class="image-zone"><img id="pro-img-1" src="{{asset($media->link)}}"></div>
                                    </div>
                                    @endforeach
                                    @endif

                                </div>
                            </div>
                            @endisset

                            <div class="col-md-12 ">
                                <button class="btn btn-primary float-right" type="submit">
                                    @isset($oldlivre)
                                    Modifier le livre
                                    @else
                                    Ajouter  livre
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

    </script> --}}
    @isset($oldlivre)

    @endisset
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('plugins') }}/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins') }}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ asset('plugins') }}/toastr/toastr.min.js"></script>
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

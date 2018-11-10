@extends('admin.layout.base')

@section('top')
    <link rel="stylesheet" href="{{ URL('admin/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
@endsection

@section('botton')
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/buttons.bootstrap.min.js') }}'"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/datatables-init.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#bootstrap-data-table-export').DataTable();

            $(".delete_album").click(function (e) {
                e.preventDefault()
                let urlDelete = $(this).attr('href')

                if (urlDelete) {
                    $.ajax(urlDelete, {
                        method: 'DELETE',
                        data: {
                            "_token": '{{ csrf_token() }}'
                        }
                    })
                }

                location.reload()
            })

            $('#create_album').click(function (e) {
                e.preventDefault();

                let hrefCreateAlbum = $('#create_album').attr('href')

                $.ajax(hrefCreateAlbum, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                }).success(() => {
                    location.reload();
                })
            })
        })
    </script>
@endsection

@section('page_content')
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title pr-3">Lista de Albuns do Site:</strong>
                        <br><br>
                        <a id="create_album" href="{{ url("album/cadastrar") }}">
                            <button type="button"
                                    class="btn btn-success btn-sm">Cadastrar Novo
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Nº de fotos</th>
                                <th>Data Criação</th>
                                <th>Data Atualização</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($albums))
                                @foreach($albums as $album)
                                    <tr>
                                        <td>{{ $album->name }}</td>
                                        <td>{{ $album->photos->count() }}</td>
                                        <td>{{ \Carbon\Carbon::parse($album->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($album->updated_at)->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            <a href="{{ url( '/albuns/editar/' . $album->id) }}" class="pr-2">
                                                <i class="fa fa-pencil fa-2x"></i>
                                            </a>
                                            <a class="delete_album"
                                               href="{{ url('albuns/deletar/' . $album->id) }}"><i
                                                        class="fa fa-trash fa-2x"
                                                        style="color: firebrick"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

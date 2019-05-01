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

            $(".delete_project").click(function (e) {
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
        });

    </script>
@endsection

@section('page_content')
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title pr-3">Lista de Projetos</strong>
                        @can('admin')
                        <a href="{{ url('projetos/cadastrar') }}">
                            <button type="button"
                                    class="btn btn-success btn-sm">Cadastrar Novo
                            </button>
                        </a>
                        @endcan
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Endereço</th>
                                <th>Nº de Albuns</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if (!empty($projects))
                                @foreach($projects as $project)
                                    <tr>
                                        <td>{{ $project->title }}</td>
                                        <td>{{ $project->address }}</td>
                                        <td>{{ $project->albums->count() }}</td>
                                        <td class="text-center">
                                            @can('admin')
                                            <a href="{{ url('projetos/editar/' . $project->id) }}" class="pr-2">
                                                <i class="fa fa-pencil fa-2x"></i>
                                            </a>
                                            @endcan
                                            <a href="{{ url('projetos/' . $project->id) . '/albuns' }}" class="pr-2">
                                                <i class="fa fa-image fa-2x"></i>
                                            </a>
                                            {{--<a class="delete_project" href="{{ url('projetos/deletar/' . $project->id) }}"><i--}}
                                                        {{--class="fa fa-trash pl-3"--}}
                                                        {{--style="color: firebrick"></i>--}}
                                            {{--</a>--}}

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

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
        });
    </script>
@endsection

@section('page_content')
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Lista de Usuários</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>Email</th>
                                <th>Opções</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->accessType->type == 'admin' ? 'Administrador' : 'Usuário' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td class="text-center">
                                        <a href="{{ url('usuarios/editar/' . $user->id) }}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <i class="fa fa-trash pl-3" style="color: firebrick"></i>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->

@endsection

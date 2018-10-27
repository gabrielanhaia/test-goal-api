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
                        <strong class="card-title pr-3">Projeto: {{ $project->address }} </strong>
                        <br>
                        <strong class="card-title pr-3">Album: {{ $album->name }} </strong>
                        <br>
                    </div>
                    <div class="card-body">
                        Test
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

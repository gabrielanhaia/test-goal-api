@extends('admin.layout.base')

@section('top')
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
@endsection

@section('botton')
    <link href="{{  URL::asset('admin/assets/css/bootstrap-duallistbox.css') }}" rel="stylesheet">

    <script src="{{  URL::asset('admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{  URL::asset('admin/assets/js/jquery.bootstrap-duallistbox.js') }}"></script>
    <script>
        $('#users').bootstrapDualListbox({
            filterPlaceHolder: 'Filtro',
            infoText: 0,
            bootstrap3Compatible: true
        });
    </script>
@endsection

@section('page_content')
    <div class="col-lg-12">
        <form action="" method="post" class="form-horizontal" id="form">
            <div class="card">
                <div class="card-header">
                    <strong>Cadastrar</strong> Projeto
                </div>
                <div class="card-body card-block">
                    {{ csrf_field() }}
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nome</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="title" placeholder="Titulo" required
                                   class="form-control"
                                   value="{{ old('title') }}">
                            <small class="form-text text-muted">Nome do projeto.</small>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Endereço</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="address" placeholder="Endereço" required
                                   class="form-control"
                                   value="{{ old('address') }}">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="textarea-input"
                                                         class=" form-control-label">Descrição</label></div>
                        <div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9"
                                                               placeholder="Decrição do projeto."
                                                               class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Usuários</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select multiple size="10" id="users" name="users[]" title="Usuários">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Cadastrar
                    </button>
                    <a href="{{ url('projetos') }}">
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Voltar
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection
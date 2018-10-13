@extends('admin.layout.base')

@section('top')
@endsection

@section('botton')
    <script src="{{  URL::asset('admin/assets/js/lib/data-table/datatables.min.js') }}"></script>
@endsection

@section('page_content')
    <div class="col-lg-12">
        <form action="" method="post" class="form-horizontal" id="form">
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header">
                    <strong>Cadastrar</strong> Usuário
                </div>
                <div class="card-body card-block">
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nome</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" id="text-input" name="name" placeholder="Nome" required class="form-control"
                                   value="{{ old('name') }}">
                            <small class="form-text text-muted">Nome da pessoa.</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="email" id="email-input" required name="email"
                                                            placeholder="Email" class="form-control"
                                                            value="{{ old('email') }}">
                            <small class="help-block form-text">Endereço de email usado no login.</small>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Senha</label>
                        </div>
                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="password"
                                                            placeholder="Nova Senha" class="form-control">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="textarea-input"
                                                         class=" form-control-label">Descrição</label></div>
                        <div class="col-12 col-md-9"><textarea name="description" id="textarea-input" rows="9"
                                                               placeholder="Sobre o usuário"
                                                               class="form-control">{{ old('description') }}</textarea></div>
                    </div>
                    <div class="row form-group">
                        <div class="col col-md-3"><label for="select" class=" form-control-label">Tipo de Conta</label>
                        </div>
                        <div class="col-12 col-md-9">
                            <select name="type" id="type" class="form-control">
                                <option value="user">Usuário</option>
                                <option value="admin" {{ (old('type') == 'admin' ? 'selected' : '') }}>
                                    Administrador
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa fa-dot-circle-o"></i> Cadastrar
                    </button>
                    <a href="{{ url('usuarios') }}">
                        <button type="button" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Voltar
                        </button>
                    </a>
                </div>
            </div>
        </form>
    </div>

@endsection

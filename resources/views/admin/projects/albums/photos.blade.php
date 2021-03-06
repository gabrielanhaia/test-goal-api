@extends('admin.layout.base')

@section('top')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link href="{{ URL::asset('admin/fine-uploader/fine-uploader-new.css') }}" rel="stylesheet">
    <script src="{{ URL::asset('admin/fine-uploader/jquery.fine-uploader.js') }}"></script>
    <script type="text/template" id="qq-template-manual-trigger">
        <div class="qq-uploader-selector qq-uploader" qq-drop-area-text="Largue arquivos aqui">
            <div class="qq-total-progress-bar-container-selector qq-total-progress-bar-container">
                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-total-progress-bar-selector qq-progress-bar qq-total-progress-bar"></div>
            </div>
            <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
                <span class="qq-upload-drop-area-text-selector"></span>
            </div>
            <div class="buttons">
                <div class="qq-upload-button-selector qq-upload-button">
                    <div>Selecionar</div>
                </div>
                <button type="button" id="trigger-upload" class="btn btn-primary">
                    <i class="icon-upload icon-white"></i> Upload
                </button>
            </div>
            <span class="qq-drop-processing-selector qq-drop-processing">
                <span>Processing dropped files...</span>
                <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
            </span>
            <ul class="qq-upload-list-selector qq-upload-list" aria-live="polite" aria-relevant="additions removals">
                <li>
                    <div class="qq-progress-bar-container-selector">
                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" class="qq-progress-bar-selector qq-progress-bar"></div>
                    </div>
                    <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
                    <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
                    <span class="qq-upload-file-selector qq-upload-file"></span>
                    <span class="qq-edit-filename-icon-selector qq-edit-filename-icon" aria-label="Edit filename"></span>
                    <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
                    <span class="qq-upload-size-selector qq-upload-size"></span>
                    <button type="button" class="qq-btn qq-upload-cancel-selector qq-upload-cancel">Cancelar</button>
                    <button type="button" class="qq-btn qq-upload-retry-selector qq-upload-retry">Tentar Novamente</button>
                    <button type="button" class="qq-btn qq-upload-delete-selector qq-upload-delete">Deletar</button>
                    <span role="status" class="qq-upload-status-text-selector qq-upload-status-text"></span>
                </li>
            </ul>

            <dialog class="qq-alert-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Fechar</button>
                </div>
            </dialog>

            <dialog class="qq-confirm-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Não</button>
                    <button type="button" class="qq-ok-button-selector">Sim</button>
                </div>
            </dialog>

            <dialog class="qq-prompt-dialog-selector">
                <div class="qq-dialog-message-selector"></div>
                <input type="text">
                <div class="qq-dialog-buttons">
                    <button type="button" class="qq-cancel-button-selector">Cancelar</button>
                    <button type="button" class="qq-ok-button-selector">Ok</button>
                </div>
            </dialog>
        </div>
    </script>

    <style>
        #trigger-upload {
            color: white;
            background-color: #00ABC7;
            font-size: 14px;
            padding: 7px 20px;
            background-image: none;
        }

        #fine-uploader-manual-trigger .qq-upload-button {
            margin-right: 15px;
        }

        #fine-uploader-manual-trigger .buttons {
            width: 36%;
        }

        #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
            width: 60%;
        }
    </style>
@endsection

@section('botton')

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

                        <div id="fine-uploader-manual-trigger"></div>

                        <!-- Your code to create an instance of Fine Uploader and bind to the DOM/template
                        ====================================================================== -->
                        <script>
                            $('#fine-uploader-manual-trigger').fineUploader({
                                template: 'qq-template-manual-trigger',
                                request: {
                                    endpoint: "{{ url('api/images/') }}",
                                    params: {
                                        _token: "{{ csrf_token() }}",
                                        album_id: "{{ $album->id }}"
                                    }
                                },
                                thumbnails: {
                                    placeholders: {
                                        waitingPath: '/source/placeholders/waiting-generic.png',
                                        notAvailablePath: '/source/placeholders/not_available-generic.png'
                                    }
                                },
                                session: {
                                    endpoint: "{{ url('api/images/') . '/' . $album->id }}",
                                    params: {
                                        _token: "{{ csrf_token() }}"
                                    }
                                },
                                autoUpload: false,
                                deleteFile: {
                                    enabled: true,
                                    forceConfirm: true,
                                    endpoint: "{{ url('api/images/') }}"
                                }
                            });

                            $('#trigger-upload').click(function() {
                                $('#fine-uploader-manual-trigger').fineUploader('uploadStoredFiles');
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

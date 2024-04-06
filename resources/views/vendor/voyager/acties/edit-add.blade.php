@php
    $edit = !is_null($dataTypeContent->getKey());
    $add  = is_null($dataTypeContent->getKey());
    $dataTypeRows = $dataType->{($edit ? 'editRows' : 'addRows' )};
@endphp

@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop


@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.($edit ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form" action="@if($edit){{ route('voyager.acties.update', $dataTypeContent->id) }}@else{{ route('voyager.acties.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if($edit)
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}
            {{-- Form errors --}}
            <div class="row">
                <div class="col-md-6">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                {{ __('voyager::actie.title') }}
                            </h3>
                        </div>
                        <div class="panel-body">
                            {{-- @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',
                                '_field_trans' => get_field_translations($dataTypeContent, 'title')
                            ]) --}}
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('voyager::generic.title') }}" value="{{ old('title', $dataTypeContent->title ?? '') }}">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('voyager::actie.content') }}</h3>
                        </div>

                        <div class="panel-body">
                            {{-- @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'body',
                                '_field_trans' => get_field_translations($dataTypeContent, 'body')
                            ]) --}}
                            @php
                                $row = $dataTypeRows->where('field', 'body')->first();
                            @endphp
                            {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                        </div>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('voyager::actie.excerpt') }} <i class="voyager-info-circled" title="Deze beschrijving wordt gebruikt waar het aantal karakters beperkt is (bijvoorbeeld in Google-resultaten)."></i></h3>
                        </div>
                        <div class="panel-body">
                            {{-- @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt')
                            ]) --}}
                            <textarea class="form-control" style="resize: vertical;" name="excerpt">{{ old('excerpt', $dataTypeContent->excerpt ?? '') }}</textarea>
                        </div>
                    </div>
                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager::actie.image') }}</h3>
                        </div>
                        <div class="panel-body">
                            <!-- MEDIA PICKER -->
                            @php
                                if ($dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')}) {
                                    $dataTypeContent->{$row->field} = $dataTypeContent->{$row->field.'_'.($edit ? 'edit' : 'add')};
                                }
                            @endphp

                            @foreach($dataTypeRows as $row)
                                @if($row->type === 'media_picker')
                                    @php
                                        $display_options = $row->details->display ?? NULL;
                                    @endphp

                                    {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- ### ACTIE DETAILS ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i> {{ __('voyager::actie.actie_details') }}</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($dataTypeRows as $row)
                                @if ($row->field === 'time_start')
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif">
                                        <label for="time_start">{{ $row->display_name }}</label>
                                        <input class="form-control" type="datetime-local" name="time_start" value="{{old('time_start', $dataTypeContent->time_start ?? '')}}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"/>
                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @elseif ($row->field === 'time_end')
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif">
                                        <label for="time_end">{{ $row->display_name }}</label>
                                        <input class="form-control" type="datetime-local" name="time_end" value="{{old('time_end', $dataTypeContent->time_end ?? '')}}" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}"/>
                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @elseif ($row->type === 'relationship')
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        <label for="name">{{ $row->display_name }}</label>
                                        @include('voyager::formfields.relationship', ['options' => $row->details])
                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                            {{-- Externe link --}}
                            <div class="form-group">
                                <label for="name">Externe links</label>
                                <textarea class="form-control" name="externe_link">
                                    {{ old('externe_link', $dataTypeContent->externe_link ?? '') }}
                                </textarea>
                            </div>
                            {{-- Disobedient --}}
                            <div class="form-group">
                                <label for="disobedient">Burgerlijk ongehoorzaam</label><br>
                                <input 
                                    type="checkbox"
                                    name="disobedient"
                                    class="toggleswitch"
                                    data-on="Ja"
                                    data-off="Nee"
                                    value="on"
                                    @if(old('disobedient', $dataTypeContent->disobedient ?? '') == '1') checked @endif >
                            </div>
                        </div>
                    </div>
                    <!-- ### LOCATION ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ __('voyager::actie.location') }}</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($dataTypeRows as $row)
                                @if(in_array($row->field, ['location', 'location_human']))
                                    @php
                                        $display_options = $row->details->display ?? NULL;
                                    @endphp
                                    <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                        {{ $row->slugify }}
                                        <label for="name">{{ $row->display_name }}</label>
                                        {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}

                                        @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                            {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <!-- ### PUBLICATION DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> {{ __('voyager::actie.publication_details') }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="user_id">{{ __('voyager::actie.user_id') }}</label>
                                <select class="form-control" name="user_id">
                                    @foreach(Voyager::model('User')::all() as $user)
                                        <option value="{{ $user->id }}"@if(isset($dataTypeContent->user_id) && $dataTypeContent->user_id == $user->id) selected="selected"@endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="slug">{{ __('voyager::actie.slug') }}</label>
                                {{-- @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'slug',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'slug')
                                ]) --}}
                                <input type="text" class="form-control" id="slug" name="slug"
                                    placeholder="slug"
                                    {!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}
                                    value="{{ $dataTypeContent->slug ?? '' }}">
                            </div>
                            <div class="form-group">
                                <label for="status">{{ __('voyager::actie.status') }}</label> <i class="voyager-info-circled" title="Alleen acties met de status 'gepubliceerd' zijn zichtbaar voor het publiek."></i>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED') selected="selected"@endif>{{ __('voyager::actie.status_published') }}</option>
                                    <option value="DRAFT"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT') selected="selected"@endif>{{ __('voyager::actie.status_draft') }}</option>
                                    <option value="PENDING"@if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING') selected="selected"@endif>{{ __('voyager::actie.status_pending') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="keywords">{{ __('voyager::actie.keywords') }}</label> <i class="voyager-info-circled" title="Keywords worden gebruikt om de actie beter vindbaar te maken met zoekmachines."></i>
                                {{-- @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'keywords',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'keywords')
                                ]) --}}
                                <input type="text" class="form-control" name="keywords" value="{{ old('keywords', $dataTypeContent->keywords ?? '') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @section('submit-buttons')
                <button type="submit" class="btn btn-primary pull-right">
                     @if($edit){{ __('voyager::actie.update') }}@else <i class="icon wb-plus-circle"></i> {{ __('voyager::actie.new') }} @endif
                </button>
            @stop
            @yield('submit-buttons')
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
            <input name="image" id="upload_file" type="file"
                     onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
            {{ csrf_field() }}
        </form>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        var $file;

        function deleteHandler(tag, isMulti) {
          return function() {
            $file = $(this).siblings(tag);

            params = {
                slug:   '{{ $dataType->slug }}',
                filename:  $file.data('file-name'),
                id:     $file.data('id'),
                field:  $file.parent().data('field-name'),
                multi: isMulti,
                _token: '{{ csrf_token() }}'
            }

            $('.confirm_delete_name').text(params.filename);
            $('#confirm_delete_modal').modal('show');
          };
        }

        $('document').ready(function () {
            $('#slug').slugify();

            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', deleteHandler('img', true));
            $('.form-group').on('click', '.remove-single-image', deleteHandler('img', false));
            $('.form-group').on('click', '.remove-multi-file', deleteHandler('a', true));
            $('.form-group').on('click', '.remove-single-file', deleteHandler('a', false));

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.'.$dataType->slug.'.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $file.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing file.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop

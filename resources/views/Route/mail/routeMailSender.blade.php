@php
    /**
    * @var \App\Models\RouteMailSenderData $record
    */
@endphp


@extends('layouts.admin.defaultpage')

@section('title', __('messages.sendmail_title_caption'))

@section('message-area')
    @if(session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
@endsection

@section('content')

    <div class="admin-form-wrapper">
        <div class="admin-form-title">@lang('messages.sendmail_title_caption')</div>
        <form method="POST" action="{{ route('realEstateRoutes.sendmail', [$record->route_id]) }}" class="col-xl-6 col-lg-12">
            @csrf
            @method('POST')

            <div class="row">
                <div class="col-12">
                    <!-- {{ $senderCheck === false ? ' has-error' : '' }} -->
                    <div class="form-group">
                        <label for="sender" class="col-form-label">@lang('messages.sendmail_sender_label')</label>
                        <input type="email" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'sender'])" name="sender" value="{{ $record->sender }}">
                        @include('inc.field-error-message', ['fieldName' => 'sender'])
                        <span class="help-block">
                            <small>Kizárólag <i>@realhome.hu</i> végződésű e-mailcímről kézbesíthető sikeresen e-mail.</small>
                        </span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="target" class="col-form-label">@lang('messages.sendmail_target_label')</label>
                        <input type="email" class="form-control @include('inc.field-invalid-class', ['fieldName' => 'target'])" name="target" value="{{ $record->target }}">
                        @include('inc.field-error-message', ['fieldName' => 'target'])
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="subject" class="col-form-label">@lang('messages.sendmail_subject_label')</label>
                        <input class="form-control @include('inc.field-invalid-class', ['fieldName' => 'subject'])" name="subject" value="{{ $record->subject }}">
                        @include('inc.field-error-message', ['fieldName' => 'subject'])
                    </div>
                </div>
            </div>

            <input type="hidden" name="format" id="format" value="HTML" />

            {{--            <div class="row">--}}
            {{--                <div class="col-12">--}}
            {{--                    <div class="form-group">--}}
            {{--                        <label for="format" class="col-form-label">@lang('messages.sendmail_format_label')</label>--}}
            {{--                        <select class="form-control @include('inc.field-invalid-class', ['fieldName' => 'format'])" name="format">--}}
            {{--                            <option value="">@lang('messages.combobox_empty_caption')</option>--}}
            {{--                            @foreach ($mailFormats as $item)--}}
            {{--                                <option value="{{$item->id}}" @if ($record->format == $item->id) selected @endif>{{$item->caption}}</option>--}}
            {{--                            @endforeach--}}
            {{--                        </select>--}}
            {{--                        @include('inc.field-error-message', ['fieldName' => 'format'])--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="message" class="col-form-label">@lang('messages.sendmail_message_label')</label>
                        <textarea class="form-control @include('inc.field-invalid-class', ['fieldName' => 'message'])" name="message">{{$record->message}}</textarea>
                        @include('inc.field-error-message', ['fieldName' => 'message'])
                    </div>
                </div>
            </div>
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="form-check">--}}
{{--                            <input class="form-check-input" type="checkbox" name="ccCheck" id="bccCheck" value="true">--}}
{{--                            <input type="hidden" name="cc" id="cc" value="{{ $record->cc }}">--}}
{{--                            <label class="form-check-label" for="ccCheck">--}}
{{--                                @lang('messages.sendmail_cc') {{ $record->cc }}--}}
{{--                            </label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="row" style="margin-top: 20px;">
                <div class="col-12">
{{--                    <input type="submit" {{ $senderCheck === false ? 'disabled': '' }} class="btn btn-primary {{ $senderCheck === false ? 'disabled': '' }}" value="@lang('messages.button_send_caption')" />--}}
                    <input type="submit" class="btn btn-primary" value="@lang('messages.button_send_caption')" />
                </div>
            </div>
        </form>


    </div>
@endsection

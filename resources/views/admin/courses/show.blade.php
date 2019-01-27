@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.courses.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.courses.fields.professors')</th>
                            <td field-key='professors'>
                                @foreach ($course->professors as $singleProfessors)
                                    <span class="label label-info label-many">{{ $singleProfessors->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.courses.fields.title')</th>
                            <td field-key='title'>{{ $course->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.courses.fields.slug')</th>
                            <td field-key='slug'>{{ $course->slug }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.courses.fields.description')</th>
                            <td field-key='description'>{!! $course->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.courses.fields.course-image')</th>
                            <td field-key='course_image'>@if($course->course_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $course->course_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $course->course_image) }}"/></a>@endif</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.courses.fields.start-date')</th>
                            <td field-key='start_date'>{{ $course->start_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.courses.fields.published')</th>
                            <td field-key='published'>{{ Form::checkbox("published", 1, $course->published == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#lessons" aria-controls="lessons" role="tab" data-toggle="tab">Lessons</a></li>
<li role="presentation" class=""><a href="#tests" aria-controls="tests" role="tab" data-toggle="tab">Tests</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="lessons">
<table class="table table-bordered table-striped {{ count($lessons) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.lessons.fields.course')</th>
                        <th>@lang('quickadmin.lessons.fields.title')</th>
                        <th>@lang('quickadmin.lessons.fields.slug')</th>
                        <th>@lang('quickadmin.lessons.fields.lesson-image')</th>
                        <th>@lang('quickadmin.lessons.fields.short-text')</th>
                        <th>@lang('quickadmin.lessons.fields.full-text')</th>
                        <th>@lang('quickadmin.lessons.fields.position')</th>
                        <th>@lang('quickadmin.lessons.fields.published')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($lessons) > 0)
            @foreach ($lessons as $lesson)
                <tr data-entry-id="{{ $lesson->id }}">
                    <td field-key='course'>{{ $lesson->course->title ?? '' }}</td>
                                <td field-key='title'>{{ $lesson->title }}</td>
                                <td field-key='slug'>{{ $lesson->slug }}</td>
                                <td field-key='lesson_image'>@if($lesson->lesson_image)<a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->lesson_image) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $lesson->lesson_image) }}"/></a>@endif</td>
                                <td field-key='short_text'>{!! $lesson->short_text !!}</td>
                                <td field-key='full_text'>{!! $lesson->full_text !!}</td>
                                <td field-key='position'>{{ $lesson->position }}</td>
                                <td field-key='downloadable_files'>@if($lesson->downloadable_files)<a href="{{ asset(env('UPLOAD_PATH').'/' . $lesson->downloadable_files) }}" target="_blank">Download file</a>@endif</td>
                                <td field-key='published'>{{ Form::checkbox("published", 1, $lesson->published == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('lesson_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.lessons.restore', $lesson->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('lesson_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.lessons.perma_del', $lesson->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('lesson_view')
                                    <a href="{{ route('admin.lessons.show',[$lesson->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('lesson_edit')
                                    <a href="{{ route('admin.lessons.edit',[$lesson->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('lesson_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.lessons.destroy', $lesson->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="tests">
<table class="table table-bordered table-striped {{ count($tests) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.tests.fields.course')</th>
                        <th>@lang('quickadmin.tests.fields.lesson')</th>
                        <th>@lang('quickadmin.tests.fields.title')</th>
                        <th>@lang('quickadmin.tests.fields.description')</th>
                        <th>@lang('quickadmin.tests.fields.questions')</th>
                        <th>@lang('quickadmin.tests.fields.publised')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($tests) > 0)
            @foreach ($tests as $test)
                <tr data-entry-id="{{ $test->id }}">
                    <td field-key='course'>{{ $test->course->title ?? '' }}</td>
                                <td field-key='lesson'>{{ $test->lesson->title ?? '' }}</td>
                                <td field-key='title'>{{ $test->title }}</td>
                                <td field-key='description'>{{ $test->description }}</td>
                                <td field-key='questions'>
                                    @foreach ($test->questions as $singleQuestions)
                                        <span class="label label-info label-many">{{ $singleQuestions->question }}</span>
                                    @endforeach
                                </td>
                                <td field-key='publised'>{{ Form::checkbox("publised", 1, $test->publised == 1 ? true : false, ["disabled"]) }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('test_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tests.restore', $test->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('test_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tests.perma_del', $test->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('test_view')
                                    <a href="{{ route('admin.tests.show',[$test->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('test_edit')
                                    <a href="{{ route('admin.tests.edit',[$test->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('test_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.tests.destroy', $test->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.courses.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
@stop

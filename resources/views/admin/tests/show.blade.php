@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.tests.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.tests.fields.course')</th>
                            <td field-key='course'>{{ $test->course->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tests.fields.lesson')</th>
                            <td field-key='lesson'>{{ $test->lesson->title ?? '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tests.fields.title')</th>
                            <td field-key='title'>{{ $test->title }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tests.fields.description')</th>
                            <td field-key='description'>{{ $test->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tests.fields.questions')</th>
                            <td field-key='questions'>
                                @foreach ($test->questions as $singleQuestions)
                                    <span class="label label-info label-many">{{ $singleQuestions->question }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.tests.fields.publised')</th>
                            <td field-key='publised'>{{ Form::checkbox("publised", 1, $test->publised == 1 ? true : false, ["disabled"]) }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.tests.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop



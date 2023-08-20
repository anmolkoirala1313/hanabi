@extends('formbuilder::layout')
@section('title') Submissions @endsection
@section('css')

    <style>
        .footable .btn .caret {
            margin-left: 0;
            display: none;
        }

        button.dt-button.buttons-excel.buttons-html5{
            color: #fff !important;
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            padding: 0.25rem 0.5rem !important;
            font-size: .875rem !important;
            line-height: 1.5 !important;
            border-radius: 0.2rem !important;
        }


        button.dt-button.buttons-excel.buttons-html5 {
            color: #fff !important;
            background-color: #1e7e34 !important;
            border-color: #1c7430 !important;
        }

        button.dt-button.buttons-copy.buttons-html5{
            color: #fff !important;
            background-color: #0062cc !important;
            border-color: #005cbf !important;
            padding: 0.25rem 0.5rem !important;
            font-size: .875rem !important;
            line-height: 1.5 !important;
            border-radius: 0.2rem !important;
        }

        button.dt-button.buttons-copy.buttons-html5 {
            color: #fff !important;
            background-color: #0062cc !important;
            border-color: #005cbf !important;
        }

        div#submission-index_wrapper {
            margin-top: 10px;
        }


        div.dt-buttons {
            margin-right: 10px;
            margin-left: 10px;
        }
    </style>
@endsection
@section('content')
    <div class="page-content">

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card rounded-0">
                        <div class="card-header">
                            <h5 class="card-title">
                                {{ $pageTitle }} ({{ $submissions->count() }})

                                <a href="{{ route('formbuilder::forms.index') }}" class="btn btn-primary float-md-end btn-sm">
                                    <i class="fa fa-arrow-left"></i> Back To Forms
                                </a>
                            </h5>
                        </div>

                        @if($submissions->count())
                            <div class="table-responsive">
                                <table id="submission-index" class="table table-bordered d-table table-striped pb-0 mb-0">
                                    <thead>
                                    <tr>
                                        <th class="five">#</th>
                                        <th class="fifteen">User Name</th>
                                        @foreach($form_headers as $header)
                                            <th>{{ $header['label'] ?? title_case($header['name']) }}</th>
                                        @endforeach
                                        <th class="fifteen">Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($submissions as $submission)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $submission->user->name ?? 'n/a' }}</td>
                                            @foreach($form_headers as $header)
                                                <td>
                                                    {{
                                                        $submission->renderEntryContent(
                                                            $header['name'], $header['type'], true
                                                        )
                                                    }}
                                                </td>
                                            @endforeach
                                            <td>
                                                <a href="{{ route('formbuilder::forms.submissions.show', [$form, $submission->id]) }}" class="btn btn-primary btn-sm" title="View submission">
                                                    <i class="fa fa-eye"></i> View
                                                </a>

                                                <form action="{{ route('formbuilder::forms.submissions.destroy', [$form, $submission]) }}" method="POST" id="deleteSubmissionForm_{{ $submission->id }}" class="d-inline-block">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger btn-sm confirm-form" data-form="deleteSubmissionForm_{{ $submission->id }}" data-message="Delete this submission?" title="Delete submission">
                                                        <i class="fa fa-trash-o"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($submissions->hasPages())
                                <div class="card-footer mb-0 pb-0">
                                    <div>{{ $submissions->links() }}</div>
                                </div>
                            @endif
                        @else
                            <div class="card-body">
                                <h4 class="text-danger text-center">
                                    No submission to display.
                                </h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

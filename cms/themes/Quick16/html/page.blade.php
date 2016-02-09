@extends('master')

@section('main-contents')
            <div class="row">
                <div id="page-contents" class="@if($toc) col-sm-8 @else col-sm-12 @endif">
                    {!! $contents !!}
                </div>
                @if ($toc)
                <div id="sidebar" class="col-sm-4">
                    <nav>
                        {!! $toc !!}
                    </nav>
                </div>
                @endif
            </div>
@endsection

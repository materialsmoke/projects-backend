@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <project :project="{{ json_encode($project) }}"></project>
        </div>
    </div>
</div>
@endsection

@extends('layouts.widget')

@section('content')

    <div id="app">
		<div>
			<widget-agenda
				:acties="{{ $acties }}"
			>
        	</widget-agenda>
		</div>
    </div>
@endsection
<style>
	
</style>
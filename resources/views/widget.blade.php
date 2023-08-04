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
@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });
    </script>
@endpush
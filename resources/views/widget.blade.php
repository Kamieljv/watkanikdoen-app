@extends('layouts.widget')

@section('content')

    <div id="app">
		<div style="min-height:610px">
			<widget-agenda
				:routes="{{ $routes }}"
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
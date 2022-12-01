@extends('layouts.app')

@section('content')
    <div class="relative">
        <div id="image-banner" style="background-image:url(images/Banner_nocolor.jpg);"
        class="h-[200px] md:h-[300px] bg-center bg-cover grayscale brightness-[0.7] contrast-[1.5]"></div>
        <div id="gradient-banner" class="absolute inset-0 bg-gradient-to-r from-[var(--wkid-pink)] to-[var(--wkid-blue)] opacity-70"></div>
        <h1 class="absolute w-full bottom-0 text-center leading-[0.7] text-white uppercase text-4xl md:text-5xl md:leading-[0.7]">
            {{ config('brand.title') }}
        </h1>
    </div>
    <div class="row">
        <div id="welcome" class="md:max-w-2xl px-3 md:px-0 my-8 m-auto text-center flex flex-col items-center justify-center">
            @svg('custom-vormpje', ['style' => 'fill: var(--wkid-blue-light); height: 100px; opacity: 0.2; position: absolute'])
            <p class="relative">
                {!! config('brand.description_html') !!}
            </p>
        </div>
    </div>
    <div id="app">
        <home-agenda
            :routes="{{ $routes }}"
            :themes="{{ $themes }}"
            :categories="{{ $categories }}"
        >
        </home-agenda>
        <!-- Statistics section -->
		<div id="stats-section" v-if="!isError" class="row py-10 px-3 text-white bg-[color:var(--wkid-blue)]">
			<div class="flex flex-col mx-auto max-w-6xl px-3 items-center">
				<h1>De cijfers tot nu toe...</h1>
				<div class="flex w-full my-8">
					<div class="flex-col w-1/3 text-center">
						<span class="stat text-5xl font-bold scroll-reveal" data-val="{{$stats["acties"]}}">0</span>
						<p>acties</p>
					</div>
					<div class="flex-col w-1/3 text-center">
						<span class="stat text-5xl font-bold scroll-reveal" data-val="{{$stats["organizers"]}}">0</span>
						<p>organisatoren</p>
					</div>
					<div class="flex-col w-1/3 text-center">
						<span class="stat text-5xl font-bold scroll-reveal" data-val="{{$stats["themes"]}}">0</span>
						<p>thema's</p>
					</div>
				</div>
			</div>
		</div>
    </div>
@endsection

@push('scripts')
    <script type="application/javascript">
        var app = new Vue({
            el: '#app',
        });

        function animateValue(obj, start, end, duration) {
			let startTimestamp = null;
			const step = (timestamp) => {
				if (!startTimestamp) startTimestamp = timestamp;
				const progress = Math.min((timestamp - startTimestamp) / duration, 1);
				obj.innerHTML = Math.floor(progress * (end - start) - start);
				if (progress < 1) {
					window.requestAnimationFrame(step);
				}
			};
			window.requestAnimationFrame(step);
		}

        const observer = new IntersectionObserver(entries => {
			// Loop over the entries
			entries.forEach(entry => {
				// If the element is visible
				console.log(entry, entry.target)
				if (entry.isIntersecting) {
					// Add the animation class
					animateValue(entry.target, 0, Number(entry.target.dataset.val), 500);
				}
			});
		});
		// Add observers to all stat elements
		const stats = document.querySelectorAll('span.stat');
		stats.forEach((s) => observer.observe(s));
    </script>
@endpush
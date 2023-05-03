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
		<div style="min-height:610px">
			<home-agenda
				:routes="{{ $routes }}"
				:themes="{{ $themes }}"
				:categories="{{ $categories }}"
			>
        	</home-agenda>
		</div>
		{{-- Who are we? --}}
		<div id="whoarewe-section" class="row text-white relative overflow-hidden" style="height: 300px">
			<div class="absolute left-[20%] opacity-20" style="top: -110%">
				@svg('logo-icon', ['style' => 'width: 800px;fill: #fff'])
			</div>
			<div class="absolute w-full top-1/2 -translate-y-2/4 flex flex-col mx-auto  items-center">
				<h1>Wat is Watkanikdoen.nl?</h1>
				<p>Test test</p>
			</div>
		</div>
		{{-- Organizers --}}
		<div id="organizers-section" class="row py-20 px-3 text-gray-800">
			<div class="grid grid-cols-3 mx-auto max-w-6xl px-3 items-center">
				<div class="col-span-1 text-right">
					<h1>Organisatoren</h1>
					<p>Zonder organisator geen actie. Alle organisatoren zijn gekoppeld aan een of meerdere thema's.</p>
				</div>
				<div class="col-span-2 flex flex-col"> 
					{{-- Show highlighted organizers here --}}
				</div>
			</div>
		</div>
        <!-- Statistics -->
		<div id="stats-section" class="row relative py-20 px-3 text-white overflow-hidden bg-[color:var(--wkid-blue)]">
			<div class="flex flex-col mx-auto max-w-6xl px-3 items-center">
				<h1>Er gebeurt hier al ontzettend veel!</h1>
				<div class="flex w-full mt-10">
					<div class="flex-col w-1/3 text-center">
						<span class="stat font-bold scroll-reveal" data-val="{{$stats["acties"]}}">0</span>
						<p class="font-bold text-2xl">acties</p>
					</div>
					<div class="flex-col w-1/3 text-center">
						<span class="stat font-bold scroll-reveal" data-val="{{$stats["organizers"]}}">0</span>
						<p class="font-bold text-2xl">organisatoren</p>
					</div>
					<div class="flex-col w-1/3 text-center">
						<span class="stat font-bold scroll-reveal" data-val="{{$stats["themes"]}}">0</span>
						<p class="font-bold text-2xl">thema's</p>
					</div>
				</div>
			</div>
		</div>
    </div>
@endsection
<style>
	.stat {
		font-size: 5rem;
		line-height: 4rem;
	}
	#whoarewe-section {
		position: relative;
		background: var(--wkid-pink);  
		background: linear-gradient(to top left, var(--wkid-pink), #91368b);  
		width: 100%;
	}
	#stats-section {
		background: var(--wkid-blue);  
		background: linear-gradient(to top left, var(--wkid-blue), #ca467a);  
		width: 100%;
	}

	.ball {
		position: absolute;
		border-radius: 100%;
		opacity: 0.3;
	}
</style>
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
				if (entry.isIntersecting) {
					// Add the animation class
					animateValue(entry.target, 0, Number(entry.target.dataset.val), 500);
				}
			});
		});

		// Add observers to all stat elements
		const stats = document.querySelectorAll('span.stat');
		stats.forEach((s) => observer.observe(s));

		// Background animation for stats
		const colors = ["#ffffff"];

		const numBalls = 10;
		const balls = [];

		for (let i = 0; i < numBalls; i++) {
			let ball = document.createElement("div");
			ball.classList.add("ball");
			ball.style.background = colors[Math.floor(Math.random() * colors.length)];
			ball.style.left = `${Math.floor(Math.random() * 100)}%`;
			ball.style.top = `${Math.floor(Math.random() * 100)}%`;
			ball.style.transform = `scale(${0.5+Math.random()})`;
			ball.style.width = `${0.4+Math.random()}em`;
			ball.style.height = ball.style.width;
			
			balls.push(ball);
			document.getElementById('stats-section').appendChild(ball);
		}

		// Keyframes
		balls.forEach((el, i, ra) => {
			let to = {
				x: Math.random() * (i % 2 === 0 ? -11 : 11),
				y: Math.random() * (i % 2 === 0 ? -5 : 5)
			};
			let to2 = {
				x: Math.random() * (i % 2 === 0 ? -11 : 11),
				y: Math.random() * (i % 2 === 0 ? -5 : 5)
			};

			let anim = el.animate(
				[
					{ transform: "translate(0, 0)" },
					{ transform: `translate(${to.x}rem, ${to.y}rem)` }
				],
				{
					duration: (Math.random() + 1) * 2000, // random duration
					direction: "alternate",
					fill: "both",
					iterations: Infinity,
					easing: "ease-in-out"
				}
			);
		});
    </script>
@endpush
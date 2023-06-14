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
			>
        	</home-agenda>
		</div>
		{{-- Who are we? --}}
		<div id="whoarewe-section" class="row h-[450px] md:h-[370px] text-white relative overflow-hidden">
			<div class="absolute left-[-30%] md:left-[20%] top-[-70%] md:top-[-110%] opacity-20">
				@svg('logo-icon', ['style' => 'width: 800px;fill: #fff'])
			</div>
			<div class="absolute w-full top-1/2 -translate-y-2/4 flex flex-col mx-auto text-center items-center">
				<h1>Wat is Watkanikdoen.nl?</h1>
				<div class="w-full px-8 md:w-1/2 text-center font-medium mt-3">
					<p>
						Wij geloven dat iedereen wel iets heeft om de straat voor op te gaan. 
						Of het je nu gaat om de klimaatcrisis, institutioneel racisme of dierenrechten. Daarom ontwikkelen we digitale tools
						die het makkelijker maken voor jou om je stem te laten horen en jouw plek in een beweging te vinden.
					</p>
				</div>
				<div class="flex items-center justify-center mt-12">
					<a href="/over-ons">
						<button class="secondary-white flex items-center hover:translate-x-[0.250rem]">
							<p class="text-lg">{{__('general.about_us')}}</p>
							<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
						</button>
					</a>
				</div>
			</div>
		</div>
		{{-- Organizers --}}
		<div id="organizers-section" class="row py-20 px-3 text-gray-800">
			<div class="grid grid-cols-1 md:grid-cols-3 mx-auto max-w-6xl px-3 items-center md:divide-x">
				<div class="col-span-1 text-left md:text-right pr-5 mb-8 md:mb-0">
					<h1>Organisatoren</h1>
					<p>Zonder organisator geen actie. Alle organisatoren zijn gekoppeld aan een of meerdere thema's.</p>
				</div>
				<div class="col-span-2 flex flex-col md:pl-5"> 
					<organizers-featured
						:routes="{{ $routes }}"
					/>
				</div>
			</div>
			<div class="flex items-center justify-center mt-12">
				<a href="/organisatoren/index">
					<button class="primary flex items-center hover:translate-x-[0.250rem]">
						<p class="text-lg">{{__('organizers.view_all_organizers')}}</p>
						<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
					</button>
				</a>
			</div>
		</div>
        <!-- Statistics -->
		<div id="stats-section" class="row relative py-20 md:py-32 px-3 text-white overflow-hidden bg-[color:var(--wkid-blue)]">
			<div class="flex flex-col mx-auto max-w-6xl px-3 items-center text-center">
				<h1>Er is genoeg wat jíj kan doen!</h1>
				<div class="flex flex-col md:flex-row w-full space-y-14 md:space-y-0 mt-10 items-center">
					<div class="flex-col w-full md:w-1/3 text-center">
						<a href="/acties">
							<span class="stat font-bold scroll-reveal" data-val="{{$stats["acties"]}}">0</span>
							<p class="font-bold text-2xl">acties</p>
						</a>
					</div>
					<div class="flex-col w-full md:w-1/3 text-center">
						<a href="/organisatoren/index">
							<span class="stat font-bold scroll-reveal" data-val="{{$stats["organizers"]}}">0</span>
							<p class="font-bold text-2xl">organisatoren</p>
						</a>
					</div>
					<div class="flex-col w-full md:w-1/3 text-center">
						<span class="stat font-bold scroll-reveal" data-val="{{$stats["themes"]}}">0</span>
						<p class="font-bold text-2xl">thema's</p>
					</div>
				</div>
			</div>
		</div>
		{{-- Newsletter --}}
		<div id="newsletter-section" class="row py-20 px-3 text-gray-800">
			<div class="w-full flex flex-col mx-auto text-center items-center">
				<h1>Op de hoogte blijven van onze ontwikkelingen?</h1>
				<div class="w-full px-8 md:w-1/2 text-center font-medium mt-3">
					<p>
						Nieuwe features? Samenwerkingen? Een recap van de gaafste acties van de afgelopen periode?
						We zijn begonnen met een nieuwsbrief, waarmee we abonnees op de hoogte houden van nieuwe ontwikkelingen
						op dit platform. Meld je aan!
					</p>
				</div>
			</div>
			<div class="flex items-center justify-center mt-12">
				<a href="/nieuwsbrief">
					<button class="primary flex items-center hover:translate-x-[0.250rem]">
						<p class="text-lg">{{__('newsletter.subscribe_call_to_action')}}</p>
						<svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 ml-1" style="transform: rotate(180deg);"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
					</button>
				</a>
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
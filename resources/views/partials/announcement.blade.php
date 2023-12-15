<a href="{{$announcement->url}}" data-umami-event="announcement: {{$announcement->title}}">
	<div id="announcement" class="flex items-center justify-center h-12" style="background-color: {{$announcement->color}}">
		<div class="flex w-full items-center justify-center hover:translate-x-[0.250rem] transition duration-150 ease-in-out">
			<span class="font-bold">{{$announcement->title}}</span>
			<div class="truncate hidden sm:block">&nbsp;&#x2022;&nbsp;{{$announcement->description}}&nbsp;</div>
			<div class="ml-1 sm:ml-0">@svg('clarity-angle-double-line', ['style' => 'width: 20px; height: 20px; transform: rotate(90deg)'])</div>
		</div>
	</div>
</a>
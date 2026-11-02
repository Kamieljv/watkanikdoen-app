<div class="max-w-3xl mx-auto mt-16">

    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900">
            Geef ons feedback
        </h2>

        <p class="mt-3 text-gray-600">
            Heb je een suggestie, een vraag of iets gevonden dat niet helemaal
            goed werkt? We horen het graag van je!
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 rounded-lg bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 rounded-lg bg-red-100 text-red-800">
            <p class="font-semibold mb-2">
                Er ging iets mis bij het versturen:
            </p>

            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('feedback.store') }}" method="POST"
          class="space-y-6">

        @csrf

        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                Naam
            </label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                maxlength="255"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Je naam (optioneel)"
            >

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                E-mailadres
            </label>

            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                maxlength="255"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Je e-mailadres (optioneel)"
            >

            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="subject" class="block text-sm font-semibold text-gray-700 mb-2">
                Onderwerp
            </label>

            <input
                type="text"
                name="subject"
                id="subject"
                value="{{ old('subject') }}"
                maxlength="255"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Waar gaat je feedback over?"
            >

            @error('subject')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                Bericht <span class="text-red-500">*</span>
            </label>

            <textarea
                name="message"
                id="message"
                rows="6"
                required
                maxlength="5000"
                class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Vertel ons wat je kwijt wilt..."
            >{{ old('message') }}</textarea>

            @error('message')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button
                type="submit"
                class="inline-flex items-center px-6 py-3 rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition-colors"
            >
                Verstuur feedback
            </button>
        </div>

    </form>

</div>

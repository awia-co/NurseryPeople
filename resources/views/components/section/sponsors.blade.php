<section class="relative bg-gray-50 px-4 pt-16 pb-20 sm:px-6 lg:px-8 lg:pt-24 lg:pb-28">
    <div class="absolute inset-0">
        <div class="h-1/3 bg-white sm:h-2/3"></div>
    </div>
    <div class="relative mx-auto max-w-7xl">
        <div class="text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Nursery People Sponsors</h2>
            <p class="mx-auto mt-3 max-w-2xl text-xl text-gray-500 sm:mt-4">We're thankful to these companies who sponsor Nursery People.</p>
        </div>
        <div class="mx-auto mt-12 grid max-w-lg gap-5 lg:max-w-none lg:grid-cols-3">
            @forelse($sponsors as $sponsor)
            <div class="flex flex-col overflow-hidden rounded-lg shadow-lg">
                <div class="flex-shrink-0">
                    <img class="h-48 w-full" src="{{$sponsor->logo}}" alt="{{$sponsor->name}}">
                </div>
                <div class="flex flex-1 flex-col justify-between bg-white p-6">
                    <div class="flex-1">
                        <a href="#" class="mt-2 block">
                            <h3 class="text-xl font-semibold text-gray-900">{{ $sponsor->name }}</h3>
                            <p class="mt-3 text-base text-gray-500">{{ $sponsor->description }}</p>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
        </div>
    </div>
</section>
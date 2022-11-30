<div class="overflow-hidden bg-white">
  <div class="relative mx-auto max-w-7xl py-16 px-4 sm:px-6 lg:px-8">
    <div class="absolute top-0 bottom-0 left-3/4 hidden w-screen bg-gray-50 lg:block"></div>

    <div class="mt-8 lg:grid lg:grid-cols-2 lg:gap-8  items-center">
      <div class="mt-8 lg:mt-0">
        <div class="mx-auto mb-8 max-w-prose">
          <div>
            @if(isset($title))
            <h2 class="text-lg font-semibold text-indigo-600">{{$title}}</h2>
            @endif
            @if(isset($subtitle))
            <h3 class="mt-2 text-4xl font-bold leading-8 tracking-tight text-gray-900 sm:text-5xl">{{$subtitle}}</h3>
            @endif
          </div>
        </div>
        @if(isset($paragraph))
        <div class="mx-auto max-w-prose text-base lg:max-w-none">
          <p class="text-lg text-gray-500">{{$paragraph}}</p>
        </div>
        @endif
        <div class="prose prose-indigo mx-auto mt-5 text-gray-500 lg:col-start-1 lg:row-start-1 lg:max-w-none">
          {{$slot}}
        </div>
      </div>
      <div class="relative lg:col-start-2 lg:row-start-1">
        <svg class="absolute top-0 right-0 -mt-20 -mr-20 hidden lg:block" width="404" height="384" fill="none" viewBox="0 0 404 384" aria-hidden="true">
          <defs>
            <pattern id="de316486-4a29-4312-bdfc-fbce2132a2c1" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
              <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
            </pattern>
          </defs>
          <rect width="404" height="384" fill="url(#de316486-4a29-4312-bdfc-fbce2132a2c1)" />
        </svg>
        <div class="relative mx-auto max-w-prose text-base lg:max-w-none">
          <figure>
            <div class="aspect-w-12 aspect-h-4 lg:aspect-none">
              <img class="rounded-lg object-cover object-center shadow-lg" src="https://images.unsplash.com/photo-1546913199-55e06682967e?ixlib=rb-1.2.1&auto=format&fit=crop&crop=focalpoint&fp-x=.735&fp-y=.55&w=1184&h=1376&q=80" alt="Whitney leaning against a railing on a downtown street" width="1184" height="1376">
            </div>
            @if(isset($imgcaption))
            <figcaption class="mt-3 flex text-sm text-gray-500">
              <!-- Heroicon name: mini/camera -->
              <svg class="h-5 w-5 flex-none text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0016.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
              </svg>
              <span class="ml-2">{{$imgcaption}}</span>
            </figcaption>
            @endif
          </figure>
        </div>
      </div>
    </div>
  </div>
</div>
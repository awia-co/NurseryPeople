<div class="overflow-hidden bg-white">
  <div class="relative mx-auto max-w-7xl py-16 px-4 sm:px-6 lg:px-8">
    <div class="absolute top-0 bottom-0 @if($imageRight) left-3/4 @else right-3/4 @endif hidden w-screen bg-gray-50 lg:block"></div>

    <div class="mt-8 lg:grid lg:grid-cols-2 lg:gap-8  items-center">
      <div class="mt-8 lg:mt-0">
        <div class="mx-auto mb-8 max-w-prose">
          <div>
            @if(isset($title))
            <h2 class="text-lg font-semibold text-pink-600">{{$title}}</h2>
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
        <div class="prose prose-pink mx-auto mt-5 text-gray-500 lg:col-start-1 lg:row-start-1 lg:max-w-none">
          {{$slot}}
        </div>
      </div>
      <div class="relative @if($imageRight) lg:col-start-2 @else lg:col-start-1 @endif lg:row-start-1">
        <div class="relative mx-auto max-w-prose text-base lg:max-w-none">
          <figure>
            <div class="aspect-w-12 aspect-h-4 lg:aspect-none">
              <image class="rounded-lg object-cover object-center shadow-lg" src="{{$imagesrc}}" alt="{{ $imagecaption }}" width="1184" height="1376">
            </div>
            @if(isset($imagecaption))
            <figcaption class="mt-3 flex text-sm text-gray-500">
              <!-- Heroicon name: mini/camera -->
              <svg class="h-5 w-5 flex-none text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M1 8a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 018.07 3h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0016.07 6H17a2 2 0 012 2v7a2 2 0 01-2 2H3a2 2 0 01-2-2V8zm13.5 3a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM10 14a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
              </svg>
              <span class="ml-2">{{$imagecaption}}</span>
            </figcaption>
            @endif
          </figure>
        </div>
      </div>
    </div>
  </div>
</div>
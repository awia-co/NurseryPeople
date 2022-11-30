<section class="py-40 bg-white">
  <x-structure.container>
    <h1 class="text-6xl mb-12 text-center font-extrabold tracking-tight">Search for Plants or Nurseries</h1>
    <form method="GET" action=" {{ route('search') }}" class="mx-auto flex items-center justify-center">
      @csrf
      <x-form.text-input name="search" type="text" placeholder="Search input" class="px-4 py-4 text-lg" />
      <x-primary-button type="submit" class="text-lg px-6 py-4 capitalize">Search</x-primary-button>
    </form>
  </x-structure.container>
</section>
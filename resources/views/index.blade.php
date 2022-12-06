<x-app-layout>
  <x-section.hero-search />
  <x-section.two-column title="Search Plants" subtitle="Find and save plants." imagesrc="/images/thundercloud-plum-photo.jpg" imagecaption="Thundercloud plum flowers.">
    <x-slot:paragraph>
      Needing a certain hard to find plant? Search for it on our site, and save it for later. See what nurseries grow, and find what plants are most common.
    </x-slot:paragraph>
  </x-section.two-column>
  <x-section.two-column title="Wholesale Nurseries" subtitle="Find nurseries in your state." imagesrc="/images/posts-trees.jpeg" imagecaption="Garden Gate Nursery" :imageRight="false">
    <x-slot:paragraph>
      Needing a certain hard to find plant? Search for it on our site, and save it for later. See what nurseries grow, and find what plants are most common.
    </x-slot:paragraph>
  </x-section.two-column>
  <x-section.sponsors />
  <x-navigation.footer />
</x-app-layout>
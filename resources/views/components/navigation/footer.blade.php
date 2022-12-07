<footer class="bg-white" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="space-y-8 xl:col-span-1 pt-12">
                <a href="{{ route('home') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
                <p class="text-base text-gray-500">Coalition of nursery people and plant lovers.</p>

            </div>
            <div class="mt-12 xl:col-span-2 grid lg:grid-cols-4">
                <div class="lg:col-start-4">
                    <h3 class="text-base font-medium text-gray-900">Website</h3>
                    <ul role="list" class="mt-4 space-y-4">
                        <li>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900">About</a>
                        </li>

                        <li>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900">Plants</a>
                        </li>

                        <li>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900">Nurseries</a>
                        </li>

                        <li>
                            <a href="#" class="text-base text-gray-500 hover:text-gray-900">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-gray-200 pt-8">
            <p class="text-base text-gray-400 xl:text-center">&copy; 2020 NurseryPeople an Awia Co. Company. All rights reserved.</p>
        </div>
    </div>
</footer>
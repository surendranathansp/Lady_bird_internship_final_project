<x-guest-layout>
    <!-- Main Hero Content -->
    <div class="container max-w-lg px-4 py-32 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center"
        style="background-image: url('https://img.nerdburglars.net/wp-content/uploads/2023/03/Nerdburglars_create_an_image_of_a_chef_in_a_kitchen_63ebd5e2-649f-4f15-beb2-ed13fc2c628d-transformed.jpg')">
        <h1
            class="font-mono text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 md:text-center sm:leading-none lg:text-5xl">
            <span class="inline md:block">{{ trans('welcome.welcome') }}</span>
        </h1>
        <div class="mx-auto mt-2 text-green-50 md:text-center lg:text-lg">
           {{trans('welcome.hero_subtitle')}}
        </div>
        <div class="flex flex-col items-center mt-12 text-center">
            <span class="relative inline-flex w-full md:w-auto">
                <a href="{{ route('reservations.step.one') }}" type="button"
                    class="inline-flex items-center justify-center px-6 py-2 text-base font-bold leading-6 text-white bg-green-600 rounded-full lg:w-full md:w-auto hover:bg-green-500 focus:outline-none">
                    {{ trans('welcome.make_reservation') }}
                </a>
        </div>
    </div>
    <!-- End Main Hero Content -->
    <section class="px-2 py-32 bg-white md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <div class="w-full md:w-1/2 md:px-3">
                    <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pr-0 md:pb-0">
                        <!-- <h1
              class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-4xl lg:text-5xl xl:text-6xl"
            > -->
                        <h3 class="text-xl">{{ trans('welcome.our_story') }}
                        </h3>
                        <h2 class="text-4xl text-green-600">{{ trans('welcome.welcome1') }}</h2>
                        <!-- </h1> -->
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                            {{ trans('welcome.content') }}  
                        </p>
                        <div class="relative flex">
                            <a href="#_"
                                class="flex items-center w-full px-6 py-3 mb-3 text-lg text-white bg-green-600 rounded-md sm:mb-0 hover:bg-green-700 sm:w-auto">
                                {{ trans('welcome.read_more') }}  
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
                        <img src="https://i.insider.com/594d4b06298d4a691c8b46b2?width=1000&format=jpeg&auto=webp" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-20 bg-gray-50">
        <div class="container items-center max-w-6xl px-4 px-10 mx-auto sm:px-20 md:px-32 lg:px-16">
            <div class="flex flex-wrap items-center -mx-3">
                <div class="order-1 w-full px-3 lg:w-1/2 lg:order-0">
                    <div class="w-full lg:max-w-md">
                        <h2 class="mb-4 text-2xl font-bold">{{trans('welcome.about_us')}}</h2>
                        <h2
                            class="mb-4 text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                            {{trans('welcome.why_choose_us')}}</h2>

                        <p class="mb-4 font-medium tracking-tight text-gray-400 xl:mb-6">{{trans('welcome.about_content')}}</p>
                        <ul>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-500">{{trans('welcome.faster_processing')}}</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-500" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="font-medium text-gray-500">{{trans('welcome.easy_payments')}}</span>
                            </li>
                            <li class="flex items-center py-2 space-x-4 xl:py-3">
                                <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <span class="font-medium text-gray-500">{{trans('welcome.protection_security')}}</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-3 mb-12 lg:w-1/2 order-0 lg:order-1 lg:mb-0"><img
                        class="mx-auto sm:max-w-sm lg:max-w-full"
                        src="https://cdn.pixabay.com/photo/2020/12/31/12/28/cook-5876388_960_720.png"
                        alt="feature image"></div>
            </div>
        </div>
    </section>
    <section class="mt-8 bg-white">
        <div class="mt-4 text-center">
            <h3 class="text-2xl font-bold">{{trans('welcome.our_menu')}}</h3>
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                {{trans('welcome.speciality')}}
            </h2>
        </div>
    
        <div class="container w-full px-5 py-6 mx-auto">
            <div class="grid lg:grid-cols-4 gap-y-6">
    
                @if ($specials && $specials->menus)
                    @foreach ($specials->menus as $menu)
                        <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                            <img class="w-full h-48" src="{{ Storage::url($menu->image) }}" alt="Image" />
                            <div class="px-6 py-4">
                                <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                                    {{ $menu->name }}
                                </h4>
                                <p class="leading-normal text-gray-700">{{ $menu->description }}.</p>
                            </div>
                            <div class="flex items-center justify-between p-4">
                                <span class="text-xl text-green-600">${{ $menu->price }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No specials available at the moment.</p>
                @endif
    
            </div>
        </div>
    </section>
    
    <section class="pt-4 pb-12 bg-gray-800">
        <div class="my-16 text-center">
            <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
                {{trans('welcome.testimonial_heading')}} </h2>
            <p class="text-xl text-white">{{trans('welcome.testimonial_subtitle')}}</p>
        </div>
        <div class="grid gap-2 lg:grid-cols-3">
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full"
                        src="data:image/jpeg;base64,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">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-green-500">{{trans('welcome.first_testimonial_title')}}</h2>
                    <p class="mt-2 text-white">{{trans('welcome.first_testimonial_content')}}</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">{{trans('welcome.first_testimonial_author')}}</a>
                </div>
            </div>
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full"
                        src="https://w0.peakpx.com/wallpaper/978/295/HD-wallpaper-avenger-end-game-marvel-tony-stark-robert-downey-jr.jpg">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-green-500">{{trans('welcome.second_testimonial_title')}}</h2>
                    <p class="mt-2 text-white">{{trans('welcome.second_testimonial_content')}}</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">{{trans('welcome.second_testimonial_author')}}</a>
                </div>
            </div>
            <div class="max-w-md p-4 bg-white rounded-lg shadow-lg">
                <div class="flex justify-center -mt-16 md:justify-end">
                    <img class="object-cover w-20 h-20 border-2 border-green-500 rounded-full"
                        src="https://cdn.britannica.com/89/152989-050-DDF277EA/Johnny-Depp-2011.jpg">
                </div>
                <div>
                    <h2 class="text-3xl font-semibold text-green-500">{{trans('welcome.third_testimonial_title')}}</h2>
                    <p class="mt-2 text-white">{{trans('welcome.third_testimonial_content')}}</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="#" class="text-xl font-medium text-green-500">{{trans('welcome.third_testimonial_author')}}</a>
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>

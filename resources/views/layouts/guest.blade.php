<!DOCTYPE html>
<html dir="{{(App::isLocale('ar') ? 'rtl' : 'ltr')}}" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body style="background-color: black;">
    <div class="bg-white shadow-md" x-data="{ isOpen: false }">
        <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center"
            style="background-image: url('https://img.freepik.com/free-photo/black-smooth-textured-paper_53876-96064.jpg'); background-size: cover; background-position: center;">
            <!-- ... Rest of your code ... -->
            <div class="flex items-center justify-between">
                <a class="text-xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 md:text-2xl hover:text-green-400"
                    href="#">
                    FusionFeast
                </a>

                <!-- Mobile menu button -->
                <div @click="isOpen = !isOpen" class="flex md:hidden">
                    <button type="button"
                        class="text-gray-800 hover:text-gray-400 focus:outline-none focus:text-gray-400"
                        aria-label="toggle menu">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <div :class="isOpen ? 'flex' : 'hidden'"
            class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
            <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                href="/">{{trans('welcome.home')}}</a>
            <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                href="{{ route('categories.index') }}">{{trans('welcome.categories')}}</a>
            <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                href="{{ route('menus.index') }}">{{trans('welcome.our_menu1')}}</a>
            <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                href="{{ route('reservations.step.one') }}">{{trans('welcome.make_reservation1')}}</a>
                                    
                @auth
                @if(auth()->user()->is_admin)
                    <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                        href={{ url('/admin') }}>{{trans('welcome.admin_dashboard')}}</a>
                @endif
            @endauth

       

            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Language
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    @foreach (Config::get('languages') as $lang => $language)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400" href="{{ route('lang.switch', $lang) }}">
                                <i class="flag-icon flag-icon-{{ $language['flag-icon'] }}"></i> {{ $language['display'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
            
            
                
            @guest
            <!-- Add the switch button only for guests (not authenticated users) -->
            <a class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 hover:text-green-400"
                href="{{ route('login') }}">{{trans('welcome.switch_to_admin') }}</a>
            @endguest
        </div>
       
        
            @if(isset($error))
            <div class="weather-widget-error">{{ $error }}</div>
        @elseif(isset($weather))
            <div class="weather-widget">
                <h3>{{ $weather['name'] }}, {{ $weather['sys']['country'] }}</h3>
                <p>{{ $weather['weather'][0]['description'] }}</p>
                <p>Temperature: {{ $weather['main']['temp'] }}°C</p>
                <p>Humidity: {{ $weather['main']['humidity'] }}%</p>
            </div>
        @endif
        
        </div>
        </nav>
    </div>
    <div class="font-sans text-gray-900 antialiased min-h-screen">
        {{ $slot }}
    </div>
    <footer class="bg-gray-800 border-t border-gray-200">
        <div class="container flex flex-wrap items-center justify-center px-4 py-8 mx-auto lg:justify-between">
            <div class="flex flex-wrap justify-center">
                <ul class="flex items-center space-x-4 text-white">
                    <li>{{trans('guest.home')}}</li>
                    <li>{{trans('guest.about')}}</li>
                    <li>{{trans('guest.contact')}}</li>
                    <li>{{trans('guest.terms')}}</li>
                </ul>
            </div>
            <div class="flex justify-center mt-4 lg:mt-0">
                <a>
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-6 h-6 text-blue-600" viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        class="w-6 h-6 text-blue-300" viewBox="0 0 24 24">
                        <path
                            d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                        </path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" class="w-6 h-6 text-pink-400" viewBox="0 0 24 24">
                        <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                        <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                    </svg>
                </a>
                <a class="ml-3">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="0" class="w-6 h-6 text-blue-500" viewBox="0 0 24 24">
                        <path stroke="none"
                            d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                        </path>
                        <circle cx="4" cy="4" r="2" stroke="none"></circle>
                    </svg>
                </a>
                
       

            </div>
        </div>
    </footer>
</body>

</html>

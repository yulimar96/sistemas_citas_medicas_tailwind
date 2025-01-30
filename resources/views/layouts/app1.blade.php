<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
@include('layouts.head')

<body>
    {{-- <img src="{{asset('img/fondo/fondo5.png')}}" alt="logo" class="relative w-full" /> --}}
    <!-- ====== Navbar Section Start -->
    @include('layouts.navbar')
    <!-- ====== Navbar Section End -->
    <!-- ====== Hero Section Start -->
    <div id="home" class="relative pt-[120px] lg:pt-[130px] lg:pt-[180px]bg-transparent py-2"
        style="background-image: linear-gradient(to bottom, #ffffff, #f0eded); opacity: 0.7;">
        <div class="w-full"> <!-- Contenedor que ocupa todo el ancho -->
            <div class="flex flex-wrap items-center"> <!-- Sin márgenes negativos -->
                <div class="text-center wow fadeInUp"data-wow-delay=".3s">
                    {{-- <img src="{{asset('img/inti/campo.jpg')}}" alt="imagen grande" class="w-full transition duration-300 ease-in-out opacity-100 h-auyto" /> --}}
                    {{-- <img src="assets/img/inti/campo.jpg" alt="imagen grande" class="w-full transition duration-300 ease-in-out opacity-100 h-auyto" /> --}}
                </div>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
    <!-- ====== Back To Top Start -->
    {{-- <a href="javascript:void(0)"
        class="
    hidde items-center
    justify-center
    text-white w-10 h-10
    rounded-md fixed
    bottom-8 right-8
    left-auto z-[999]
    hover:bg-dark
    back-to-top shadow-md
    transition duration-300
    ease-in-out sel-color"
        style="background:#d7974c !important;">

        <svg class="w-8 h-8 text-white-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
        </svg>

    </a> --}}

    <!-- ====== Back To Top End -->

    <!-- ====== All Scripts -->

    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/boxicons.js') }}"></script>
    <script src="{{ asset('js/flowbite.min.js') }}"></script>
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('js/blockadblock.min.js') }}"></script>
    {{-- <script rc="https://unpkg.com/flowbite@1.4.0/dist/flowbite.min.js"></script> --}}

    <script>
        // ==== for menu scroll
        const pageLink = document.querySelectorAll(".ud-menu-scroll");
        pageLink.forEach((elem) => {
            elem.addEventListener("click", (e) => {
                e.preventDefault();
                document.querySelector(elem.getAttribute("href")).scrollIntoView({
                    behavior: "smooth",
                    offsetTop: 1 - 60,
                });
            });
        });
        // section menu active
        function onScroll(event) {
            const sections = document.querySelectorAll(".ud-menu-scroll");
            const scrollPos =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop;

            for (let i = 0; i < sections.length; i++) {
                const currLink = sections[i];
                const val = currLink.getAttribute("href");
                const refElement = document.querySelector(val);
                const scrollTopMinus = scrollPos + 73;
                if (
                    refElement.offsetTop <= scrollTopMinus &&
                    refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
                ) {
                    document
                        .querySelector(".ud-menu-scroll")
                        .classList.remove("active");
                    currLink.classList.add("active");
                } else {
                    currLink.classList.remove("active");
                }
            }
        }

        window.document.addEventListener("scroll", onScroll);
    </script>
    @stack('js')
</body>

</html>

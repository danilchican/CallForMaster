@include('adminpanel.partials.head')

<!-- Сайдбар -->
@include('adminpanel.partials.sidebar')

<!-- Область контента -->
@yield('content')

<!-- Подвал админ-панели-->
@include('adminpanel.partials.footer')


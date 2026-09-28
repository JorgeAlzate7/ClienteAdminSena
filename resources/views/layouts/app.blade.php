<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>SENA</title>


    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    <!-- Bootstrap Icons -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    >


    <!-- CSS GENERAL -->

    <link
        rel="stylesheet"
        href="{{ asset('css/app.css') }}"
    >


    <!-- CSS NAVBAR -->

    <link
        rel="stylesheet"
        href="{{ asset('css/components/navbar.css') }}"
    >


    <!-- CSS FOOTER -->

    <link
        rel="stylesheet"
        href="{{ asset('css/components/footer.css') }}"
    >


    <!-- CSS DE CADA PÁGINA -->

    @yield('css')

</head>


<body>


    {{-- NAVBAR --}}

    @include('includes.navbar')


    {{-- CONTENIDO DE CADA PÁGINA --}}

    @yield('content')


    {{-- FOOTER --}}

    @include('includes.footer')


    <!-- Bootstrap JS -->

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js">
    </script>


</body>

</html>
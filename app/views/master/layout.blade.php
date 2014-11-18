<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.html-head')
</head>

<body onload="prettyPrint()">
    @include('partials.navigation')

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            @yield('content')

        </div>
        <!-- /.row -->

        @include('partials.footer')
    </div>
    <!-- /.container -->

   @include('partials.jquery-includes')
</body>

</html>
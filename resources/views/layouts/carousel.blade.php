<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class=""></li>
        <li data-target="#myCarousel" data-slide-to="1" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="2" class=""></li>
        <li data-target="#myCarousel" data-slide-to="3" class=""></li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item">
            <img class="img-fluid" src="{{Storage::url('img/1.jpg')}}" height="400" class="d-block w-100"
                 alt="1" style="width:100%;">
        </div>
        <div class="carousel-item active">
            <img class="img-fluid" src="{{Storage::url('img/2.jpg')}}" height="400"
                 class="d-block w-100" alt="2" style="width:100%;">
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="{{Storage::url('img/5.jpg')}}" class="d-block w-100" height="400" alt="3"
                 style="width:100%;">
        </div>
        <div class="carousel-item">
            <img class="img-fluid" src="{{Storage::url('img/4.jpg')}}" class="d-block w-100" height="400" alt="4"
                 style="width:100%;">
        </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>



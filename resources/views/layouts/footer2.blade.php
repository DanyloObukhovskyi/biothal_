<!-- Footer -->
<style>
    .btn {
        display: block;
        width: 100%;
        padding: 4px 0px;
        font-size: 1em;
    }
    div.col-2{
        padding: 0;
        margin-right: 4px;
    }
    .container.bars{
        margin-top: 20px;
        border: 1px solid grey;
        background:rgba(112, 128, 144, 0.2)
    }
    .container.buttons{

        border: 1px solid grey;
        border-top: 0;
    }
    .progress {
        border-radius: 100px;
        background-color: #f8f9fa;
        box-shadow: 0px 0px 4px 1px rgba(0, 0, 0, 0.192);
    }
    .progress-bar.active {
        border-radius: 100px;
        background-color: #007bff;
    }
    .progress-bar.success {
        background-color: green;
        transition: width .6s ease, background-color .3s .3s ease-in;

    }
    .progress-bar.fail {
        background-color: red;
        transition: width .6s ease, background-color .3s .3s ease-in;

    }
    .progress-bar-text {
        font-weight: 500;
    }
</style>

<div class="container my-5">


    <!-- Section: Block Content -->
    <section>

        <h6 class="font-weight-bold text-center grey-text text-uppercase small mb-4">Admin</h6>
        <h3 class="font-weight-bold text-center dark-grey-text pb-2">Statistic Data</h3>
        <hr class="w-header my-4">
        <p class="lead text-center text-muted pt-2 mb-5">Lorem ipsum dolor sit amet consectetur adipisicing elit ex facere quas possimus.</p>

        <div class="row white-text">

            <!-- Grid column -->
            <div class="col-xl-3 col-md-6 mb-4">

                <!-- Card Primary -->
                <div class="card classic-admin-card primary-color">
                    <div class="card-body py-3">
                        <i class="far fa-money-bill-alt"></i>
                        <p class="small">SALES</p>
                        <h4>2000$</h4>
                    </div>
                    <div class="progress md-progress">
                        <div class="progress-bar grey darken-3" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-body pt-2 pb-3">
                        <p class="small mb-0">Better than last week (25%)</p>
                    </div>
                </div>
                <!-- Card Primary -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-xl-3 col-md-6 mb-4">

                <!-- Card Yellow -->
                <div class="card classic-admin-card warning-color">
                    <div class="card-body py-3">
                        <i class="fas fa-chart-line"></i>
                        <p class="small">SUBSCRIPTIONS</p>
                        <h4>200</h4>
                    </div>
                    <div class="progress md-progress">
                        <div class="progress-bar bg grey darken-3" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-body pt-2 pb-3">
                        <p class="small mb-0">Worse than last week (25%)</p>
                    </div>
                </div>
                <!-- Card Yellow -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-xl-3 col-md-6 mb-4">

                <!-- Card Blue -->
                <div class="card classic-admin-card light-blue lighten-1">
                    <div class="card-body py-3">
                        <i class="fas fa-chart-pie"></i>
                        <p class="small">TRAFFIC</p>
                        <h4>20000</h4>
                    </div>
                    <div class="progress md-progress">
                        <div class="progress-bar grey darken-3" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-body pt-2 pb-3">
                        <p class="small mb-0">Better than last week (75%)</p>
                    </div>
                </div>
                <!-- Card Blue -->

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-xl-3 col-md-6 mb-4">

                <!-- Card Red -->
                <div class="card classic-admin-card red accent-2">
                    <div class="card-body py-3">
                        <i class="fas fa-chart-bar"></i>
                        <p class="small">ORGANIC TRAFFIC</p>
                        <h4>2000</h4>
                    </div>
                    <div class="progress md-progress">
                        <div class="progress-bar grey darken-3" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="card-body pt-2 pb-3">
                        <p class="small mb-0">Better than last week (25%)</p>
                    </div>
                </div>
                <!-- Card Red -->

            </div>
            <!-- Grid column -->

        </div>

    </section>
    <!-- Section: Block Content -->


</div>


<div class="container">
    <div class="container bars py-4">
        <div id="bar4" class="progress my-4">
            <div class="progress-bar active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <span class="progress-bar-text"></span>
            </div>
        </div>
    </div>

    <div class="container buttons">
        <div class="row py-2 justify-content-center">
            <div class="col-2 col-md-1">
                <button type="button" id="btn1" class="btn btn-outline-danger">10%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn2" class="btn btn-outline-danger ">20%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn3" class="btn btn-outline-primary ">30%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn4" class="btn btn-outline-primary ">40%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn5" class="btn btn-outline-primary ">50%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn6" class="btn btn-outline-primary ">60%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn7" class="btn btn-outline-primary ">70%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn8" class="btn btn-outline-primary ">80%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn9" class="btn btn-outline-primary ">90%</button>
            </div>
            <div class="col-2 col-md-1">
                <button type="button" id="btn10" class="btn btn-outline-success ">100%</button>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 p-5 z-depth-1 unique-color-dark bg-primary text-white text-center text-lg-start">


    <!--Section: Content-->
    <section class="text-center white-text">

        <!-- Section heading -->
        <h2 class="font-weight-bold mb-4 pb-2 text-uppercase">Features</h2>
        <!-- Section description -->
        <p class="lead mx-auto mb-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 mb-4">

                <i class="fas fa-brain fa-3x purple-text"></i>
                <h5 class="font-weight-bold my-4 text-uppercase">Creativity</h5>
                <p class="mb-md-0 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                    maiores aperiam minima assumenda deleniti hic.
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 mb-4">

                <i class="fab fa-sass fa-3x purple-text"></i>
                <h5 class="font-weight-bold my-4 text-uppercase">Coding</h5>
                <p class="mb-md-0 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                    maiores aperiam minima assumenda deleniti hic.
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 mb-4">

                <i class="fas fa-users fa-3x purple-text"></i>
                <h5 class="font-weight-bold my-4 text-uppercase">Professionalism</h5>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores
                    aperiam minima assumenda deleniti hic.
                </p>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->
        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 mb-4">

                <i class="fas fa-brain fa-3x purple-text"></i>
                <h5 class="font-weight-bold my-4 text-uppercase">Creativity</h5>
                <p class="mb-md-0 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                    maiores aperiam minima assumenda deleniti hic.
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 mb-4">

                <i class="fab fa-sass fa-3x purple-text"></i>
                <h5 class="font-weight-bold my-4 text-uppercase">Coding</h5>
                <p class="mb-md-0 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit
                    maiores aperiam minima assumenda deleniti hic.
                </p>

            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 mb-4">

                <i class="fas fa-users fa-3x purple-text"></i>
                <h5 class="font-weight-bold my-4 text-uppercase">Professionalism</h5>
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reprehenderit maiores
                    aperiam minima assumenda deleniti hic.
                </p>

            </div>
            <!-- Grid column -->

        </div>
        <!-- Grid row -->

    </section>
    <!--Section: Content-->


</div>

<div class="container pt-5 my-5 z-depth-1">
    <section class="p-md-3 mx-md-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="far fa-paper-plane indigo-text pr-2"></i> Feature 1
                </h4>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-pen-alt green-text pr-2"></i> Feature 2
                </h4>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-user amber-text pr-2"></i> Feature 3
                </h4>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-rocket red-text pr-2"></i> Feature 4
                </h4>
                <p class="text-muted">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-home lime-text pr-2"></i> Feature 5
                </h4>
                <p class="text-muted mb-lg-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-book-open blue-text pr-2"></i> Feature 6
                </h4>
                <p class="text-muted mb-lg-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-book pink-text pr-2"></i> Feature 7
                </h4>
                <p class="text-muted mb-md-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h4 class="font-weight-bold mb-3">
                    <i class="fas fa-paper-plane purple-text pr-2"></i> Feature 8
                </h4>
                <p class="text-muted mb-md-0">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                </p>
            </div>
        </div>
    </section>
</div>

<script>
    function init() {
        $('.progress').each(function () {
            $this = $(this);
            var progressValue = $this.children().attr('aria-valuenow');
            $this.children().width(progressValue + "%");
            if (progressValue != 100) {
                $this.children().children().text(progressValue + "%");
            }
        })
    }

    function set(selector, value) {
        $(selector).children().removeClass('success fail');

        $(selector).children().attr('aria-valuenow', value);
        if(value>100){
            console.log('value over 100');
        } else if (value == 100) {
            $(selector).children().attr('aria-valuenow', value);
            $(selector).children().children().html('<i class="fas fa-check"></i>');
            $(selector).children().addClass('success');
        } else if (value < 30) {
            $(selector).children().addClass('fail');
        }
        init();
    }

    set('#bar1', 10);
    set('#bar2', 20);
    set('#bar3', 30);
    set('#bar4', 90);

    $('#btn1').on("click", function () {
        set('#bar4', 10)
    });
    $('#btn2').on("click", function () {
        set('#bar4', 20)
    });
    $('#btn3').on("click", function () {
        set('#bar4', 30)
    });
    $('#btn4').on("click", function () {
        set('#bar4', 40)
    });
    $('#btn5').on("click", function () {
        set('#bar4', 50)
    });
    $('#btn6').on("click", function () {
        set('#bar4', 60)
    });
    $('#btn7').on("click", function () {
        set('#bar4', 70)
    });
    $('#btn8').on("click", function () {
        set('#bar4', 80)
    });
    $('#btn9').on("click", function () {
        set('#bar4', 90)
    });
    $('#btn10').on("click", function () {
        set('#bar4', 100)
    });

</script>

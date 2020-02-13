@extends('admin.layout')
@section('content')
        <div class="content-wrapper">
            <br>
            <section class="content">
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-shopping-cart"></i></span>
                            <div class="info-box-content"> <span class="info-box-text">New Orders</span> <span class="info-box-number">0</small></span> </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-spinner"></i></span>
                            <div class="info-box-content"> <span class="info-box-text">Processing Orders</span><span class="info-box-number">0</small></span></div>
                        </div>
                    </div>
                    <div class="clearfix visible-sm-block"></div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-truck"></i></span>
                            <div class="info-box-content"> <span class="info-box-text">Delivered Orders</span> <span class="info-box-number">0</span> </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box"> <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                            <div class="info-box-content"> <span class="info-box-text">Total Revenue</span> <span class="info-box-number">0</span> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h1>Author Dashboard</h1>
                    </div>
                </div>
            </section>
        </div>
@endsection
@section('footer')
    <script src="/cmadmin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <script src="/cmadmin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/cmadmin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="/cmadmin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="/cmadmin/bower_components/chart.js/Chart.js"></script>
    <script src="/cmadmin/dist/js/pages/dashboard2.js"></script>
@endsection
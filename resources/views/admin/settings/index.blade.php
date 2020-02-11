 @extends('admin.layout') 
 @section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>Global Settings</h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="/settings">Global Settings</a></li>
        </ol>
    </section>
    @include('admin.partials.flashMessage')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="">
                    <div class="global-settings-cover">
                        <div class="row user">
                            <div class="col-md-3">
                                <div class="tile p-0 gb-settings-body" style="background: #fff;">
                                    <ul class="nav nav-stacked gb-nav">
                                        <li class="nav-item active"><a class="nav-link active" href="#general" data-toggle="tab">General</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#site-logo" data-toggle="tab">Site Logo</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#footer-seo" data-toggle="tab">Footer &amp; SEO</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#social-links" data-toggle="tab">Social Links</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#analytics" data-toggle="tab">Analytics</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#payments" data-toggle="tab">Payments</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general">
                                        @include('admin.settings.includes.general')
                                    </div>
                                    <div class="tab-pane fade" id="site-logo">
                                        @include('admin.settings.includes.logo')
                                    </div>
                                    <div class="tab-pane fade" id="footer-seo">
                                        @include('admin.settings.includes.footer_seo')
                                    </div>
                                    <div class="tab-pane fade" id="social-links">
                                        @include('admin.settings.includes.social_links')
                                    </div>
                                    <div class="tab-pane fade" id="analytics">
                                        @include('admin.settings.includes.analytics')
                                    </div>
                                    <div class="tab-pane fade" id="payments">
                                        @include('admin.settings.includes.payments')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>  
 @endsection
 @section('script')
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
 @endsection
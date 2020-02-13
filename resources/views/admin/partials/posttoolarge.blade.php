@extends('admin.layout')
@section('header')
    <link rel="stylesheet" type="text/css" href="/cmadmin/parsley/parsley.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="error-page">
        <div class="error-content">
          	<h3><i class="fa fa-warning text-yellow"></i> Oops! File size too large.</h3>
			<p>The file you uploaded exceeds the size permitted by the server.</p>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    </section>

</div>
@endsection
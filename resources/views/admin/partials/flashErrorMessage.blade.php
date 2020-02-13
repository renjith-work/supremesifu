@if(Session::has('success'))
	<div class="alert smr_success" role="alert">
		<strong>Success :</strong> {{ Session::get('success') }}
	</div>
@endif

@if(count($errors) > 0)
	<div class="alert smr_error" role="alert">
		<strong> Errors : </strong>
		@foreach($errors->all() as $error)
		<ul>
			<li>{{ $error }}</li>
		</ul>
		@endforeach
	</div>
@endif
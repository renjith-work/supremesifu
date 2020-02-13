@if(Session::has('success'))
	<div class="alert smr_success" role="alert">
		<strong>Success :</strong> {{ Session::get('success') }}
	</div>
@endif
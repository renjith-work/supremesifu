@component('mail::message')
<h1>Hi there!</h1>

<h2>Welcome to Our Company! You're almost ready to avail our services. Here's what you need to know:</h2>

<p>Once your account is created, we have send you an email to verify your email account. Please follow the link in the email to verify your email address with our website.</p>

<p>Once you have signed in you can do the follwoing - </p>
<p>
	<ul>
		<li>Step 1</li>
		<li>Step 2</li>
		<li>Step 3</li>
	</ul>
</p> 

@component('mail::button', ['url' => 'http://pixtent.pixpect'])
Visit Pixtent.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

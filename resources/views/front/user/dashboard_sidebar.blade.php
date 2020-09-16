<!-- Nav tabs -->
<ul class="nav flex-column px-dashboard-list">
    <li><a href="/user/dashboard" class="{{ Active::checkRoute(['user.dashboard' ]) }}">Dashboard</a></li>
    <li> <a href="/user/account-details" class="{{ Active::checkRoute(['user.account-details.*' ]) }}">Account Details</a></li>
    <li> <a href="/user/address" class="{{ Active::checkRoute(['front.user.address.*' ]) }}">Address Book</a></li>
    <li> <a href="/user/password-reset" class="{{ Active::checkRoute(['user.password-reset.*' ]) }}">Password Reset</a></li>
</ul>
<div>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2>Verify Your Email Address</h2>

    <p>
        Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? 
        If you didn't receive the email, we will gladly send you another.
    </p>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            A fresh verification link has been sent to your email address.
        </div>
    @endif

    <form wire:submit.prevent="resend">
        <button type="submit">
            Resend Verification Email
        </button>
    </form>

    <p>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Log Out
        </a>
    </p>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>

<nav class="border-b border-border px-6">
    <div class="max-w-7xl mx-auto h-16 flex items-center justify-between">
        <a href="/">
            <div style="
            width: 50px; 
            height: 50px; 
            background-color: white; 
            -webkit-mask: url('/images/idea-logo.svg') no-repeat center;
            mask: url('/images/idea-logo.svg') no-repeat center;
            mask-size: contain;
            "></div>
        </a>

        <div class="flex gap-5 items-center">
            @auth
            <form method="POST" action="/logout">
                @csrf
                <button class="btn" type="submit">Log Out</button>
            </form>
            @endauth

            @guest
            <a href="/login">Sign In</a>
            <a href="/register" class="btn">Register</a>
            @endguest
        </div>

    </div>
</nav>

<style>
    /* Navbar Styles */
.navbar {
    background-color: #f8f9fa;
    padding: 0.5rem 1rem;
    border-bottom: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-family: Arial, sans-serif;
}

.navbar-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
}

.navbar-brand {
    font-size: 1.5rem;
    font-weight: bold;
    color: #333;
    text-decoration: none;
}

.navbar-toggler {
    font-size: 1.5rem;
    background: none;
    border: none;
    cursor: pointer;
    color: #333;
    display: none; /* Hidden by default; shown for mobile view */
}

.navbar-links {
    display: flex;
    flex-direction: row;
    align-items: center;
}

.navbar-list {
    list-style-type: none;
    margin: 0;
    padding: 0;
    display: flex;
    gap: 1rem;
}

.nav-item {
    display: flex;
    align-items: center;
}

.nav-link {
    text-decoration: none;
    color: #007bff;
    font-size: 1rem;
    padding: 0.5rem 1rem;
    transition: background-color 0.3s, color 0.3s;
}

.nav-link:hover {
    background-color: #e9ecef;
    border-radius: 5px;
    color: #0056b3;
}

.logout-form {
    margin: 0;
}

.logout-button {
    background: none;
    border: none;
    color: #007bff;
    cursor: pointer;
    font-size: 1rem;
    text-decoration: underline;
    padding: 0.5rem 1rem;
}

.logout-button:hover {
    color: #0056b3;
}

/* Responsive Styles */
@media (max-width: 768px) {
    .navbar-toggler {
        display: block;
    }

    .navbar-links {
        display: none;
        flex-direction: column;
        gap: 0;
        background-color: #f8f9fa;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
        border-top: 1px solid #ddd;
    }

    .navbar-links.open {
        display: flex;
    }

    .nav-link {
        text-align: center;
        width: 100%;
    }
}

</style>
<nav class="navbar">
    <div class="navbar-container">
        <a href="/" class="navbar-brand">QuizApp</a>
        <button class="navbar-toggler" onclick="toggleNavbar()">☰</button>
        <div class="navbar-links" id="navbarNav">
            <ul class="navbar-list">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Quizzes</a>
                </li>
                @if(Auth::check())
                    <li class="nav-item">
                        <a href="{{ route('quizzes.my') }}" class="nav-link">My Quizzes</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('quizzes.create') }}" class="nav-link">Create Quiz</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="logout-form">
                            @csrf
                            <button type="submit" class="nav-link logout-button">Logout</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

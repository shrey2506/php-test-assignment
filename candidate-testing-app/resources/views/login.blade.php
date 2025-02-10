@extends('layouts.app')

@section('title', 'Login')

  @section('content') 
   <!DOCTYPE html>
    <html>
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <style>
            /* Basic reset */
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
            }

            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            .login-container {
                width: 400px;
                background-color: #fff;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }

            .login-container h1 {
                text-align: center;
                margin-bottom: 20px;
                font-size: 24px;
                color: #333;
            }

            .login-container label {
                display: block;
                margin-bottom: 5px;
                font-weight: bold;
                color: #555;
            }

            .login-container input[type="email"],
            .login-container input[type="password"] {
                width: 100%;
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 4px;
                margin-bottom: 15px;
                font-size: 14px;
            }

            .login-container button {
                width: 100%;
                padding: 10px;
                background-color: #337ab7;
                border: none;
                border-radius: 4px;
                color: #fff;
                font-size: 16px;
                cursor: pointer;
            }

            .login-container button:hover {
                background-color: #286090;
            }

            .error {
                color: red;
                margin-bottom: 15px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h1>Login</h1>

            <!-- Display any server-side error messages -->
            @if ($errors->has('login_error'))
                <p class="error">{{ $errors->first('login_error') }}</p>
            @endif

            <!-- Placeholder for client-side validation errors -->
            <p id="client-error" class="error" style="display:none;"></p>

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <label for="email">Email:</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email') }}" 
                        required
                        placeholder="Enter your email">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        required
                        placeholder="Enter your password">
                </div>
                <button type="submit">Login</button>
            </form>
        </div>

        <script>
            // Basic client-side validation
            document.getElementById('loginForm').addEventListener('submit', function(e) {
                var emailInput = document.getElementById('email');
                var passwordInput = document.getElementById('password');
                var errorElement = document.getElementById('client-error');
                var email = emailInput.value.trim();
                var password = passwordInput.value.trim();
                var valid = true;
                var messages = [];

                // Clear previous messages
                errorElement.style.display = 'none';
                errorElement.innerHTML = '';

                // Check if email is not empty and valid
                if (!email) {
                    messages.push("Email is required.");
                    valid = false;
                } else if (!validateEmail(email)) {
                    messages.push("Please enter a valid email address.");
                    valid = false;
                }

                // Check if password is not empty
                if (!password) {
                    messages.push("Password is required.");
                    valid = false;
                }

                if (!valid) {
                    e.preventDefault(); // Prevent form submission
                    errorElement.innerHTML = messages.join("<br>");
                    errorElement.style.display = 'block';
                }
            });

            // Function to validate email format using a regular expression
            function validateEmail(email) {
                var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
        </script>
    </body>
    </html>

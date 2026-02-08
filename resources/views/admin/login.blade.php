<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login</title>
    <style>
        /* Reset some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #764A71, #4D9A94);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Centering and styling the form container */
        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: slideIn 0.5s ease-in-out;
        }

        /* Heading styling */
        .login-container h2 {
            margin-bottom: 20px;
            color: #764A71;
            font-size: 28px;
            letter-spacing: 1px;
        }

        /* Input field styling */
        .login-container input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        /* Input field hover and focus effects */
        .login-container input:focus {
            border-color: #764A71;
            outline: none;
        }

        /* Button styling */
        .login-container button {
            width: 100%;
            padding: 12px;
            background-color: #764A71;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
       
        /* Button hover effect */
        .login-container button:hover {
            background-color:  #4D9A94;
        }

        /* Error message styling */
        .login-container .error-message {
            color: red;
            margin-top: 10px;
        }

        /* Animation for sliding in effect */
        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Additional hover effect for input fields */
        .login-container input:hover {
            border-color: #4D9A94;
        }

        /* Placeholder color */
        ::placeholder {
            color: #aaa;
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .login-container {
                padding: 20px;
               
            }
           
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div>
            <img src="assets/img/logo/a_logo.png" alt="logo" style="height: 40px; width: 130px;  margin-top: 0px; margin-bottom: 25px;">
        </div>
        <h2>Admin Login</h2>
        <form method="POST" action="{{ route('admin_login') }}">
            @csrf
            <!-- Email input -->
            <div>
                <input type="email" name="email" placeholder="Admin Email" required>
            </div>
            <!-- Password input -->
            <div>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <!-- Submit button -->
            <button type="submit">Login</button>
        </form>
        <!-- Show validation errors -->
        @if ($errors->any())
            <div class="error-message">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</body>
</html>

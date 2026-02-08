<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Profile</title>
    <style>
        /* Reset default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body styling */
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right, #f3f4f6, #e8ebed);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Profile container */
        .profile-management {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        /* Title */
        .profile-management h3 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            letter-spacing: 1px;
        }

        /* Profile details */
        .profile-management p {
            font-size: 18px;
            color: #666;
            margin-bottom: 15px;
        }

        /* Logout button */
        .logout-button {
            padding: 12px 30px;
            background-color: #764A71;
            color: white;
            border: none;
            border-radius: 30px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        /* Hover effect on button */
        .logout-button:hover {
            background-color: #4D9A94;
            transform: translateY(-3px);
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 480px) {
            .profile-management {
                padding: 20px;
            }

            .profile-management h3 {
                font-size: 24px;
            }

            .profile-management p {
                font-size: 16px;
            }

            .logout-button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="profile-management">
        <h3>Profile Management</h3>
        <div>
            <img src="assets/img/logo/a_logo.png" alt="logo" style="height: 40px; width: 130px;  margin-top: 0px; margin-bottom: 25px;">
        </div>
        <p>Admin Name: {{ auth()->user()->name }}</p>
        <p>Admin Email: {{ auth()->user()->email }}</p>
        <button class="logout-button" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </button>

        <!-- Logout form (hidden) -->
        <form id="logout-form" action="{{ route('admin_logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>

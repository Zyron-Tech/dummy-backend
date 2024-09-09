# PHP Backend with Email OTP Authentication

This backend system is built with PHP, using PHPMailer for sending OTPs via email during user registration and login processes. The backend connects to a PostgreSQL database to manage users and authentication.

## How to Integrate with Frontend

### Overview

The backend provides RESTful API endpoints for sign-up, login, and OTP verification. To connect the frontend (e.g., a React, Vue, or plain HTML/JavaScript application) to the backend, you will use HTTP requests (e.g., `fetch` or `axios`) to interact with these endpoints.

### API Endpoints

1. **Sign Up Endpoint**: Registers a new user and sends an OTP to their email.
   - **URL**: `/public/signup.php`
   - **Method**: `POST`
   - **Parameters**: `username`, `password`, `email`

2. **Login Endpoint**: Logs in the user with email and password.
   - **URL**: `/public/login.php`
   - **Method**: `POST`
   - **Parameters**: `email`, `password`

3. **Verify OTP Endpoint**: Verifies the OTP sent to the user’s email during sign-up.
   - **URL**: `/public/verify-otp.php`
   - **Method**: `POST`
   - **Parameters**: `email`, `otp`

4. **Delete Account Endpoint**: Users can easily delete their account if it is no longer needed
   - **URL**: `/public/delete_account.php`
   - **Method**: `POST`
   - **Parameters**: `email`,`password` 

### Example Frontend Integration

Here's a basic HTML/JavaScript example showing how to interact with the backend API endpoints using the `fetch` API:

#### Sample Sign-Up Form

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Sign-Up</title>
</head>
<body>
    <form id="signupForm">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit">Sign Up</button>
    </form>

    <script>
        document.getElementById('signupForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch('https://dummy-backend-gyc3.onrender.com/public/signup.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                alert(result.message);
            } catch (error) {
                console.error('Error during sign-up:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>
</body>
</html>
```

#### Sample Verify Otp Code

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
</head>
<body>
    <form id="verifyOtpForm">
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit">Verify OTP</button>
    </form>

    <script>
        document.getElementById('verifyOtpForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);

            try {
                const response = await fetch('https://dummy-backend-gyc3.onrender.com/public/verify-otp.php', {
                    method: 'POST',
                    body: formData
                });
                const result = await response.json();
                alert(result.message);
            } catch (error) {
                console.error('Error during OTP verification:', error);
                alert('An error occurred. Please try again.');
            }
        });
    </script>
</body>
</html>
```


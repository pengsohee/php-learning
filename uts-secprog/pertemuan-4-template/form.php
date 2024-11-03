<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 4 - Form Validation and File Upload</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </div>
        <div>
            <label for="email">E-mail Address</label>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password-confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password-confirmation">
        </div>
        <div>
            <input type="checkbox" name="agree_terms" id="agree-terms"> I agree to terms and conditions
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
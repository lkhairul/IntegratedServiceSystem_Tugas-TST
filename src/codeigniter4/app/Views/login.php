<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
<<<<<<< HEAD
</head>
<body>
    <h2>Login</h2>
    <form action="/auth/login" method="post">
        <?= csrf_field() ?>
        <label>Email or Username</label>
        <input type="text" name="email_or_username" required>
        <br>
        <label>Password</label>
        <input type="password" name="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($validation)): ?>
        <div>
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>
=======
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-card {
            max-width: 400px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background: white;
        }
        .form-control {
            margin-bottom: 20px;
            padding: 12px;
            border-radius: 8px;
        }
        .btn-submit {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .validation-errors {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body class="bg-light">
    <?= view('navbar') ?>
    <div class="container">
        <div class="login-card">
            <h2 class="text-center mb-4">Login</h2>
            <form action="/auth/login" method="post">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label class="form-label">Email or Username</label>
                    <input type="text" name="email_or_username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-submit">Login</button>
            </form>
            <?php if (isset($validation)): ?>
                <div class="validation-errors">
                    <?= $validation->listErrors() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
>>>>>>> parent of baa28e8 (change name)
</body>
</html>
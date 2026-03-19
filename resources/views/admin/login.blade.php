<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS.success — Admin Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Nunito', sans-serif; background: #F8F8FF; min-height: 100vh; display: flex; align-items: center; justify-content: center; position: relative; overflow: hidden; }
        .bg1 { position: absolute; top: -80px; right: -80px; width: 400px; height: 400px; border-radius: 50%; background: radial-gradient(circle, #F0FFC3 0%, transparent 70%); }
        .bg2 { position: absolute; bottom: -80px; left: -80px; width: 350px; height: 350px; border-radius: 50%; background: radial-gradient(circle, #9CCFFF 0%, transparent 70%); }
        .card { position: relative; z-index: 1; background: #fff; border-radius: 24px; padding: 48px; width: 100%; max-width: 440px; box-shadow: 0 20px 60px rgba(104,90,255,0.12); border: 2px solid #F0FFC3; }
        .logo { font-family: 'Fredoka One', cursive; font-size: 32px; color: #685AFF; text-align: center; margin-bottom: 8px; }
        .logo span { color: #FF5B5B; }
        .subtitle { text-align: center; color: #888; font-size: 15px; margin-bottom: 32px; }
        .badge { display: inline-block; background: #E8E8FF; color: #685AFF; padding: 4px 16px; border-radius: 50px; font-size: 12px; font-weight: 700; margin-bottom: 24px; }
        .form-group { margin-bottom: 20px; }
        .form-label { display: block; font-weight: 700; color: #2D2D2D; margin-bottom: 8px; font-size: 14px; }
        .form-control { width: 100%; padding: 12px 16px; border-radius: 12px; border: 2px solid #eee; font-family: 'Nunito', sans-serif; font-size: 15px; outline: none; transition: border-color 0.2s; }
        .form-control:focus { border-color: #685AFF; }
        .btn { width: 100%; padding: 14px; background: #685AFF; color: #fff; border: none; border-radius: 50px; font-family: 'Fredoka One', cursive; font-size: 18px; cursor: pointer; box-shadow: 0 6px 20px rgba(104,90,255,0.35); transition: transform 0.2s; letter-spacing: 0.5px; }
        .btn:hover { transform: translateY(-2px); }
        .alert { padding: 14px 20px; border-radius: 12px; margin-bottom: 20px; font-weight: 600; font-size: 14px; }
        .alert-error { background: #FFE8E8; border: 2px solid #FF5B5B; color: #FF5B5B; }
    </style>
</head>
<body>
    <div class="bg1"></div>
    <div class="bg2"></div>
 
    <div class="card">
        <div style="text-align:center; margin-bottom:8px;">
            <span class="badge">🔐 Espace Administration</span>
        </div>
        <div class="logo">RS<span>.</span>success</div>
        <div class="subtitle">Connectez-vous pour gérer le centre</div>
 
        @if(session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif
 
        <form action="/admin/login" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Identifiant</label>
                <input type="text" name="identifiant" class="form-control" required placeholder="Ex: admin">
            </div>
            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="mot_de_passe" class="form-control" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn">🚀 Se connecter</button>
        </form>
    </div>
</body>
</html>
 
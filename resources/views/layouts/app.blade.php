<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RS.success — Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --rouge: #FF5B5B;
            --violet: #685AFF;
            --bleu: #9CCFFF;
            --jaune: #F0FFC3;
            --blanc: #ffffff;
            --gris: #F8F8FF;
            --texte: #2D2D2D;
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--gris);
            color: var(--texte);
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: 260px;
            height: 100vh;
            background: var(--blanc);
            border-right: 2px solid var(--jaune);
            display: flex;
            flex-direction: column;
            z-index: 100;
            box-shadow: 4px 0 20px rgba(104,90,255,0.07);
        }

        .sidebar-logo {
            padding: 28px 24px;
            font-family: 'Fredoka One', cursive;
            font-size: 26px;
            color: var(--violet);
            border-bottom: 2px solid var(--jaune);
        }

        .sidebar-logo span { color: var(--rouge); }

        .sidebar-subtitle {
            font-family: 'Nunito', sans-serif;
            font-size: 12px;
            color: #aaa;
            font-weight: 600;
            margin-top: 4px;
        }

        .sidebar-menu {
            padding: 20px 16px;
            flex: 1;
            overflow-y: auto;
        }

        .sidebar-section {
            font-size: 11px;
            font-weight: 800;
            color: #bbb;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 12px 8px 8px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 14px;
            text-decoration: none;
            color: var(--texte);
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 4px;
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background: var(--jaune);
            color: var(--violet);
        }

        .sidebar-link.active {
            background: var(--violet);
            color: var(--blanc);
        }

        .sidebar-link .icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .sidebar-link.active .icon { background: rgba(255,255,255,0.2); }
        .sidebar-link:not(.active) .icon { background: var(--gris); }

        .sidebar-footer {
            padding: 16px;
            border-top: 2px solid var(--jaune);
        }

        .logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 12px 16px;
            background: #FFE8E8;
            color: var(--rouge);
            border: none;
            border-radius: 14px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s;
        }

        .logout-btn:hover { background: var(--rouge); color: var(--blanc); }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 32px;
        }

        /* TOPBAR */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .topbar-title {
            font-family: 'Fredoka One', cursive;
            font-size: 32px;
            color: var(--texte);
        }

        .topbar-admin {
            display: flex;
            align-items: center;
            gap: 12px;
            background: var(--blanc);
            padding: 10px 20px;
            border-radius: 50px;
            box-shadow: 0 2px 12px rgba(104,90,255,0.1);
        }

        .topbar-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--violet);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--blanc);
            font-weight: 700;
            font-size: 16px;
        }

        .topbar-name {
            font-weight: 700;
            color: var(--texte);
            font-size: 14px;
        }

        /* ALERTS */
        .alert-success {
            background: var(--jaune);
            border: 2px solid var(--violet);
            color: var(--violet);
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        .alert-error {
            background: #FFE8E8;
            border: 2px solid var(--rouge);
            color: var(--rouge);
            padding: 14px 20px;
            border-radius: 14px;
            margin-bottom: 24px;
            font-weight: 600;
        }

        /* CARDS */
        .card {
            background: var(--blanc);
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(104,90,255,0.08);
            border: 2px solid transparent;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .card-title {
            font-family: 'Fredoka One', cursive;
            font-size: 22px;
            color: var(--texte);
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 50px;
            font-family: 'Nunito', sans-serif;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-primary {
            background: var(--violet);
            color: var(--blanc);
            box-shadow: 0 4px 12px rgba(104,90,255,0.3);
        }

        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(104,90,255,0.4); }

        .btn-danger {
            background: #FFE8E8;
            color: var(--rouge);
        }

        .btn-danger:hover { background: var(--rouge); color: var(--blanc); }

        .btn-warning {
            background: var(--jaune);
            color: var(--violet);
        }

        .btn-warning:hover { background: var(--violet); color: var(--blanc); }

        .btn-sm { padding: 6px 14px; font-size: 13px; }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--gris);
        }

        th {
            padding: 14px 16px;
            text-align: left;
            font-weight: 800;
            font-size: 13px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
            color: var(--texte);
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #FAFAFE; }

        /* BADGES */
        .badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-success { background: #E8FFF5; color: #00C853; }
        .badge-warning { background: var(--jaune); color: var(--violet); }
        .badge-danger { background: #FFE8E8; color: var(--rouge); }
        .badge-info { background: #E8E8FF; color: var(--violet); }

        /* FORMS */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block;
            font-weight: 700;
            color: var(--texte);
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border-radius: 12px;
            border: 2px solid #eee;
            font-family: 'Nunito', sans-serif;
            font-size: 15px;
            outline: none;
            transition: border-color 0.2s;
            background: var(--blanc);
        }

        .form-control:focus { border-color: var(--violet); }

        /* STATS CARDS */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--blanc);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(104,90,255,0.08);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            flex-shrink: 0;
        }

        .stat-num {
            font-family: 'Fredoka One', cursive;
            font-size: 28px;
            color: var(--texte);
            line-height: 1;
        }

        .stat-label {
            font-size: 13px;
            color: #888;
            font-weight: 600;
            margin-top: 4px;
        }

        /* GRID */
        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }

        /* IMAGE CARD */
        .img-card {
            background: var(--blanc);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(104,90,255,0.08);
            transition: transform 0.2s;
        }

        .img-card:hover { transform: translateY(-4px); }

        .img-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .img-card-body { padding: 20px; }

        .img-card-title {
            font-family: 'Fredoka One', cursive;
            font-size: 20px;
            color: var(--texte);
            margin-bottom: 8px;
        }

        .img-card-desc {
            font-size: 14px;
            color: #888;
            line-height: 1.5;
            margin-bottom: 16px;
        }

        .img-card-footer {
            padding: 14px 20px;
            border-top: 1px solid #f0f0f0;
            display: flex;
            gap: 8px;
        }

        .no-image {
            width: 100%;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <!-- Ajouter avant </aside> -->

    <aside class="sidebar">
        <div class="sidebar-logo">
            RS<span>.</span>success
            <div class="sidebar-subtitle">Espace Administration</div>
        </div>

        <nav class="sidebar-menu">
            <div class="sidebar-section">Principal</div>

            <a href="/admin/inscriptions" class="sidebar-link {{ request()->is('admin/inscriptions*') ? 'active' : '' }}">
                <div class="icon">📋</div>
                Inscriptions
            </a>

            

            <div class="sidebar-section">Contenu</div>

            <a href="/admin/cours" class="sidebar-link {{ request()->is('admin/cours*') ? 'active' : '' }}">
                <div class="icon">📚</div>
                Cours
            </a>

            <a href="/admin/activites" class="sidebar-link {{ request()->is('admin/activites*') ? 'active' : '' }}">
                <div class="icon">🎨</div>
                Activités
            </a>

            <div class="sidebar-section">Organisation</div>

            <a href="/admin/salles" class="sidebar-link {{ request()->is('admin/salles*') ? 'active' : '' }}">
                <div class="icon">🏫</div>
                Salles
            </a>

            <a href="/admin/plannings" class="sidebar-link {{ request()->is('admin/plannings*') ? 'active' : '' }}">
                <div class="icon">📅</div>
                Planning
            </a>
            <a href="/admin/paiements" class="sidebar-link {{ request()->is('admin/paiements*') ? 'active' : '' }}">
                <div class="icon">💰</div>
                Paiements
            </a>
        </nav>
        <div style="padding: 0 16px 16px;">
        <a href="http://localhost:3000" target="_blank" style="
            display: flex; align-items: center; gap: 10px;
            padding: 12px 16px; background: #F0FFC3; color: #685AFF;
            border-radius: 14px; text-decoration: none;
            font-weight: 700; font-size: 15px;">
            🌐 Voir le site
        </a>
    </div>

        <div class="sidebar-footer">
            <form action="/admin/logout" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    🚪 Se déconnecter
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <main class="main-content">
        <div class="topbar">
            <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
            <div class="topbar-admin">
                <div class="topbar-avatar">A</div>
                <div class="topbar-name">Administrateur</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert-success">✅ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert-error">❌ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

</body>
</html>
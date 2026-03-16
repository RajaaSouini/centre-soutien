@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header text-white text-center fw-bold" style="background-color:#1A3C5E;">
                Connexion Administrateur
            </div>
            <div class="card-body">
                <form action="/admin/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Identifiant</label>
                        <input type="text" name="identifiant" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="mot_de_passe" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


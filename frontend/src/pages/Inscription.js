import React, { useEffect, useState } from 'react';
import api from '../api';

export default function Inscription() {
  const [niveaux, setNiveaux] = useState([]);
  const [classes, setClasses] = useState([]);
  const [classesFiltrees, setClassesFiltrees] = useState([]);
  const [loading, setLoading] = useState(false);
  const [success, setSuccess] = useState(false);
  const [error, setError] = useState('');

  const [form, setForm] = useState({
    nom: '',
    prenom: '',
    telephone: '',
    niveau_scolaire_id: '',
    classe_scolaire_id: '',
  });

  useEffect(() => {
    const link = document.createElement('link');
    link.href = 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap';
    link.rel = 'stylesheet';
    document.head.appendChild(link);

    api.get('/niveaux').then(res => setNiveaux(res.data));
    api.get('/classes').then(res => setClasses(res.data));
  }, []);

  const handleNiveauChange = (e) => {
    const niveauId = e.target.value;
    setForm({ ...form, niveau_scolaire_id: niveauId, classe_scolaire_id: '' });
    const filtered = classes.filter(c => String(c.niveau_scolaire_id) === String(niveauId));
    setClassesFiltrees(filtered);
  };

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');
    try {
      await api.post('/inscriptions', form);
      setSuccess(true);
      setForm({ nom: '', prenom: '', telephone: '', niveau_scolaire_id: '', classe_scolaire_id: '' });
      setClassesFiltrees([]);
    } catch (err) {
      setError('Une erreur est survenue. Veuillez réessayer.');
    }
    setLoading(false);
  };

  return (
    <div style={{ fontFamily: "'Nunito', sans-serif", background: '#fff', minHeight: '100vh' }}>

      {/* NAVBAR */}
      <nav style={{
        display: 'flex', justifyContent: 'space-between', alignItems: 'center',
        padding: '18px 60px', background: '#fff',
        borderBottom: '2px solid #F0FFC3',
        boxShadow: '0 2px 20px rgba(104,90,255,0.07)',
        position: 'fixed', top: 0, left: 0, right: 0, zIndex: 100,
      }}>
        <a href="/" style={{ fontFamily: "'Fredoka One', cursive", fontSize: '28px', color: '#685AFF', textDecoration: 'none' }}>
          RS<span style={{ color: '#FF5B5B' }}>.</span>success
        </a>
        <ul style={{ display: 'flex', gap: '32px', listStyle: 'none', alignItems: 'center', margin: 0, padding: 0 }}>
          <li><a href="/" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>Accueil</a></li>
          <li><a href="/cours" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>Cours</a></li>
          <li><a href="/activites" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>Activités</a></li>
          <li><a href="/inscription" style={{
            background: '#FF5B5B', color: '#fff', padding: '10px 24px',
            borderRadius: '50px', textDecoration: 'none', fontWeight: '700', fontSize: '15px',
          }}>S'inscrire</a></li>
        </ul>
      </nav>

      {/* CONTENU */}
      <div style={{ paddingTop: '100px', paddingBottom: '80px', display: 'flex', justifyContent: 'center', alignItems: 'center', minHeight: '100vh', position: 'relative', overflow: 'hidden' }}>

        {/* Cercles décoratifs */}
        <div style={{ position: 'absolute', top: '-50px', right: '-50px', width: '400px', height: '400px', borderRadius: '50%', background: 'radial-gradient(circle, #F0FFC3 0%, transparent 70%)', zIndex: 0 }} />
        <div style={{ position: 'absolute', bottom: '-50px', left: '-50px', width: '350px', height: '350px', borderRadius: '50%', background: 'radial-gradient(circle, #9CCFFF 0%, transparent 70%)', zIndex: 0 }} />

        <div style={{ position: 'relative', zIndex: 1, width: '100%', maxWidth: '560px', padding: '0 20px' }}>

          {/* Titre */}
          <div style={{ textAlign: 'center', marginBottom: '36px' }}>
            <span style={{
              display: 'inline-block', background: '#F0FFC3', color: '#685AFF',
              padding: '6px 18px', borderRadius: '50px', fontSize: '13px',
              fontWeight: '700', marginBottom: '14px',
            }}>📝 Rejoignez-nous</span>
            <h1 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '42px', color: '#2D2D2D', marginBottom: '8px' }}>
              Formulaire d'<span style={{ color: '#685AFF' }}>inscription</span>
            </h1>
            <p style={{ color: '#888', fontSize: '16px' }}>
              Remplissez le formulaire et nous vous contacterons rapidement !
            </p>
          </div>

          {/* Message succès */}
          {success && (
            <div style={{
              background: '#F0FFC3', border: '2px solid #685AFF',
              borderRadius: '16px', padding: '20px', textAlign: 'center',
              marginBottom: '24px',
            }}>
              <div style={{ fontSize: '40px', marginBottom: '8px' }}>🎉</div>
              <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '22px', color: '#685AFF' }}>
                Inscription envoyée !
              </div>
              <div style={{ color: '#666', fontSize: '14px', marginTop: '6px' }}>
                Nous vous contacterons bientôt pour confirmer votre inscription.
              </div>
            </div>
          )}

          {/* Message erreur */}
          {error && (
            <div style={{
              background: '#FFE8E8', border: '2px solid #FF5B5B',
              borderRadius: '16px', padding: '16px', textAlign: 'center',
              marginBottom: '24px', color: '#FF5B5B', fontWeight: '600',
            }}>
              ❌ {error}
            </div>
          )}

          {/* Formulaire */}
          {!success && (
            <div style={{
              background: '#fff', borderRadius: '24px',
              boxShadow: '0 20px 60px rgba(104,90,255,0.12)',
              padding: '40px', border: '2px solid #F0FFC3',
            }}>
              <form onSubmit={handleSubmit}>

                {/* Nom & Prénom */}
                <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px', marginBottom: '20px' }}>
                  <div>
                    <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>
                      Nom *
                    </label>
                    <input
                      type="text" name="nom" value={form.nom}
                      onChange={handleChange} required
                      placeholder="Ex: Souini"
                      style={{
                        width: '100%', padding: '12px 16px', borderRadius: '12px',
                        border: '2px solid #eee', fontSize: '15px', fontFamily: "'Nunito', sans-serif",
                        outline: 'none', boxSizing: 'border-box',
                        transition: 'border-color 0.2s',
                      }}
                      onFocus={e => e.target.style.borderColor = '#685AFF'}
                      onBlur={e => e.target.style.borderColor = '#eee'}
                    />
                  </div>
                  <div>
                    <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>
                      Prénom *
                    </label>
                    <input
                      type="text" name="prenom" value={form.prenom}
                      onChange={handleChange} required
                      placeholder="Ex: Rajaa"
                      style={{
                        width: '100%', padding: '12px 16px', borderRadius: '12px',
                        border: '2px solid #eee', fontSize: '15px', fontFamily: "'Nunito', sans-serif",
                        outline: 'none', boxSizing: 'border-box',
                        transition: 'border-color 0.2s',
                      }}
                      onFocus={e => e.target.style.borderColor = '#685AFF'}
                      onBlur={e => e.target.style.borderColor = '#eee'}
                    />
                  </div>
                </div>

                {/* Téléphone */}
                <div style={{ marginBottom: '20px' }}>
                  <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>
                    Téléphone *
                  </label>
                  <input
                    type="text" name="telephone" value={form.telephone}
                    onChange={handleChange} required
                    placeholder="Ex: 06XXXXXXXX"
                    style={{
                      width: '100%', padding: '12px 16px', borderRadius: '12px',
                      border: '2px solid #eee', fontSize: '15px', fontFamily: "'Nunito', sans-serif",
                      outline: 'none', boxSizing: 'border-box',
                    }}
                    onFocus={e => e.target.style.borderColor = '#685AFF'}
                    onBlur={e => e.target.style.borderColor = '#eee'}
                  />
                </div>

                {/* Niveau */}
                <div style={{ marginBottom: '20px' }}>
                  <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>
                    Niveau scolaire *
                  </label>
                  <select
                    name="niveau_scolaire_id" value={form.niveau_scolaire_id}
                    onChange={handleNiveauChange} required
                    style={{
                      width: '100%', padding: '12px 16px', borderRadius: '12px',
                      border: '2px solid #eee', fontSize: '15px', fontFamily: "'Nunito', sans-serif",
                      outline: 'none', background: '#fff', cursor: 'pointer',
                    }}
                    onFocus={e => e.target.style.borderColor = '#685AFF'}
                    onBlur={e => e.target.style.borderColor = '#eee'}
                  >
                    <option value="">-- Choisir un niveau --</option>
                    {niveaux.map(n => (
                      <option key={n.id} value={n.id}>{n.nom}</option>
                    ))}
                  </select>
                </div>

                {/* Classe */}
                <div style={{ marginBottom: '28px' }}>
                  <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>
                    Classe *
                  </label>
                  <select
                    name="classe_scolaire_id" value={form.classe_scolaire_id}
                    onChange={handleChange} required
                    disabled={!form.niveau_scolaire_id}
                    style={{
                      width: '100%', padding: '12px 16px', borderRadius: '12px',
                      border: '2px solid #eee', fontSize: '15px', fontFamily: "'Nunito', sans-serif",
                      outline: 'none', background: form.niveau_scolaire_id ? '#fff' : '#f5f5f5',
                      cursor: form.niveau_scolaire_id ? 'pointer' : 'not-allowed',
                    }}
                    onFocus={e => e.target.style.borderColor = '#685AFF'}
                    onBlur={e => e.target.style.borderColor = '#eee'}
                  >
                    <option value="">-- Choisir une classe --</option>
                    {classesFiltrees.map(c => (
                      <option key={c.id} value={c.id}>{c.nom}</option>
                    ))}
                  </select>
                  {!form.niveau_scolaire_id && (
                    <small style={{ color: '#aaa', fontSize: '12px', marginTop: '4px', display: 'block' }}>
                      Choisissez d'abord un niveau
                    </small>
                  )}
                </div>

                {/* Bouton Submit */}
                <button
                  type="submit" disabled={loading}
                  style={{
                    width: '100%', padding: '16px',
                    background: loading ? '#aaa' : '#685AFF',
                    color: '#fff', border: 'none',
                    borderRadius: '50px', fontSize: '17px',
                    fontFamily: "'Fredoka One', cursive",
                    cursor: loading ? 'not-allowed' : 'pointer',
                    boxShadow: '0 6px 20px rgba(104,90,255,0.35)',
                    transition: 'transform 0.2s',
                    letterSpacing: '0.5px',
                  }}
                  onMouseEnter={e => { if (!loading) e.target.style.transform = 'translateY(-2px)'; }}
                  onMouseLeave={e => e.target.style.transform = 'translateY(0)'}
                >
                  {loading ? '⏳ Envoi en cours...' : '🚀 Envoyer ma demande'}
                </button>

              </form>
            </div>
          )}

        </div>
      </div>
    </div>
  );
}
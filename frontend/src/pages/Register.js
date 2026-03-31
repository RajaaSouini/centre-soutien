import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';
import api from '../api';
import { setEleve } from '../auth';

export default function Register() {
  const navigate = useNavigate();
  const [niveaux, setNiveaux] = useState([]);
  const [classes, setClasses] = useState([]);
  const [classesFiltrees, setClassesFiltrees] = useState([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const [form, setForm] = useState({
    nom: '', prenom: '', telephone: '',
    email: '', password: '',
    niveau_scolaire_id: '', classe_scolaire_id: '',
  });

  useEffect(() => {
    const link = document.createElement('link');
    link.href = 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap';
    link.rel = 'stylesheet';
    document.head.appendChild(link);
    api.get('/niveaux').then(res => setNiveaux(Array.isArray(res.data) ? res.data : []));
    api.get('/classes').then(res => setClasses(Array.isArray(res.data) ? res.data : []));
  }, []);

  const handleNiveauChange = (e) => {
    const niveauId = e.target.value;
    setForm({ ...form, niveau_scolaire_id: niveauId, classe_scolaire_id: '' });
    setClassesFiltrees(classes.filter(c => String(c.niveau_scolaire_id) === String(niveauId)));
  };

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');
    try {
      const res = await api.post('/eleve/register', form);
      setEleve(res.data.eleve);
      navigate('/cours');
    } catch (err) {
      setError(err.response?.data?.message || 'Une erreur est survenue.');
    }
    setLoading(false);
  };

  const inputStyle = {
    width: '100%', padding: '12px 16px', borderRadius: '12px',
    border: '2px solid #eee', fontSize: '15px',
    fontFamily: "'Nunito', sans-serif", outline: 'none', boxSizing: 'border-box',
  };

  const labelStyle = { display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' };

  return (
    <div style={{ fontFamily: "'Nunito', sans-serif", background: '#fff', minHeight: '100vh' }}>
      <Navbar />

      <div style={{ paddingTop: '220px', paddingBottom: '60px', minHeight: '100vh', display: 'flex', alignItems: 'center', justifyContent: 'center', position: 'relative', overflow: 'hidden' }}>
        <div style={{ position: 'absolute', top: '-50px', right: '-50px', width: '400px', height: '400px', borderRadius: '50%', background: 'radial-gradient(circle, #F0FFC3 0%, transparent 70%)', zIndex: 0 }} />
        <div style={{ position: 'absolute', bottom: '-50px', left: '-50px', width: '350px', height: '350px', borderRadius: '50%', background: 'radial-gradient(circle, #9CCFFF 0%, transparent 70%)', zIndex: 0 }} />

        <div style={{ position: 'relative', zIndex: 1, width: '100%', maxWidth: '560px', padding: '0 20px' }}>
          <div style={{ textAlign: 'center', marginBottom: '32px' }}>
            <span style={{ display: 'inline-block', background: '#F0FFC3', color: '#685AFF', padding: '6px 18px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', marginBottom: '14px' }}>📝 Rejoignez-nous</span>
            <h1 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '40px', color: '#2D2D2D', marginBottom: '8px' }}>
              Créer un <span style={{ color: '#FF5B5B' }}>compte</span>
            </h1>
            <p style={{ color: '#888', fontSize: '15px' }}>Inscrivez-vous pour accéder à vos cours</p>
          </div>

          {error && (
            <div style={{ background: '#FFE8E8', border: '2px solid #FF5B5B', borderRadius: '14px', padding: '14px', textAlign: 'center', marginBottom: '20px', color: '#FF5B5B', fontWeight: '600', fontSize: '14px' }}>❌ {error}</div>
          )}

          <div style={{ background: '#fff', borderRadius: '24px', boxShadow: '0 20px 60px rgba(104,90,255,0.12)', padding: '40px', border: '2px solid #F0FFC3' }}>
            <form onSubmit={handleSubmit}>
              <div style={{ display: 'grid', gridTemplateColumns: '1fr 1fr', gap: '16px', marginBottom: '20px' }}>
                <div>
                  <label style={labelStyle}>Nom *</label>
                  <input type="text" name="nom" value={form.nom} onChange={handleChange} required placeholder="Souini" style={inputStyle}
                    onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
                </div>
                <div>
                  <label style={labelStyle}>Prénom *</label>
                  <input type="text" name="prenom" value={form.prenom} onChange={handleChange} required placeholder="Rajaa" style={inputStyle}
                    onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
                </div>
              </div>

              <div style={{ marginBottom: '20px' }}>
                <label style={labelStyle}>Téléphone *</label>
                <input type="text" name="telephone" value={form.telephone} onChange={handleChange} required placeholder="06XXXXXXXX" style={inputStyle}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
              </div>

              <div style={{ marginBottom: '20px' }}>
                <label style={labelStyle}>Email *</label>
                <input type="email" name="email" value={form.email} onChange={handleChange} required placeholder="votre@email.com" style={inputStyle}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
              </div>

              <div style={{ marginBottom: '20px' }}>
                <label style={labelStyle}>Mot de passe *</label>
                <input type="password" name="password" value={form.password} onChange={handleChange} required placeholder="••••••••" style={inputStyle}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
              </div>

              <div style={{ marginBottom: '20px' }}>
                <label style={labelStyle}>Niveau scolaire *</label>
                <select name="niveau_scolaire_id" value={form.niveau_scolaire_id} onChange={handleNiveauChange} required style={{ ...inputStyle, background: '#fff', cursor: 'pointer' }}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'}>
                  <option value="">-- Choisir un niveau --</option>
                  {niveaux.map(n => <option key={n.id} value={n.id}>{n.nom}</option>)}
                </select>
              </div>

              <div style={{ marginBottom: '28px' }}>
                <label style={labelStyle}>Classe *</label>
                <select name="classe_scolaire_id" value={form.classe_scolaire_id} onChange={handleChange} required disabled={!form.niveau_scolaire_id}
                  style={{ ...inputStyle, background: form.niveau_scolaire_id ? '#fff' : '#f5f5f5', cursor: form.niveau_scolaire_id ? 'pointer' : 'not-allowed' }}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'}>
                  <option value="">-- Choisir une classe --</option>
                  {classesFiltrees.map(c => <option key={c.id} value={c.id}>{c.nom}</option>)}
                </select>
                {!form.niveau_scolaire_id && <small style={{ color: '#aaa', fontSize: '12px', marginTop: '4px', display: 'block' }}>Choisissez d'abord un niveau</small>}
              </div>

              <button type="submit" disabled={loading} style={{
                width: '100%', padding: '16px', background: loading ? '#aaa' : '#FF5B5B',
                color: '#fff', border: 'none', borderRadius: '50px', fontSize: '17px',
                fontFamily: "'Fredoka One', cursive", cursor: loading ? 'not-allowed' : 'pointer',
                boxShadow: '0 6px 20px rgba(255,91,91,0.35)', letterSpacing: '0.5px',
              }}>
                {loading ? '⏳ Inscription...' : '🚀 Créer mon compte'}
              </button>

              <p style={{ textAlign: 'center', marginTop: '20px', color: '#888', fontSize: '14px' }}>
                Déjà inscrit ?{' '}
                <a href="/login" style={{ color: '#685AFF', fontWeight: '700', textDecoration: 'none' }}>Se connecter</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}
import React, { useEffect, useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Navbar from '../components/Navbar';
import api from '../api';
import { setEleve, isConnected } from '../auth';

export default function Login() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ email: '', password: '' });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  useEffect(() => {
    const link = document.createElement('link');
    link.href = 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap';
    link.rel = 'stylesheet';
    document.head.appendChild(link);
    if (isConnected()) navigate('/cours');
  }, [navigate]);

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');
    try {
      const res = await api.post('/eleve/login', form);
      if (res.data.role === 'admin') {
        // Rediriger vers le back-office Laravel
        window.location.href = 'http://localhost:8000/admin/inscriptions';
      } else {
        setEleve(res.data.user);
        navigate('/cours');
      }
    } catch (err) {
      setError(err.response?.data?.message || 'Email ou mot de passe incorrect');
    }
    setLoading(false);
};

  const inputStyle = {
    width: '100%', padding: '12px 16px', borderRadius: '12px',
    border: '2px solid #eee', fontSize: '15px',
    fontFamily: "'Nunito', sans-serif", outline: 'none', boxSizing: 'border-box',
  };

  return (
    <div style={{ fontFamily: "'Nunito', sans-serif", background: '#fff', minHeight: '100vh' }}>
      <Navbar />

      <div style={{ paddingTop: '220px', minHeight: '100vh', display: 'flex', alignItems: 'center', justifyContent: 'center', position: 'relative', overflow: 'hidden' }}>
        <div style={{ position: 'absolute', top: '-50px', right: '-50px', width: '400px', height: '400px', borderRadius: '50%', background: 'radial-gradient(circle, #F0FFC3 0%, transparent 70%)', zIndex: 0 }} />
        <div style={{ position: 'absolute', bottom: '-50px', left: '-50px', width: '350px', height: '350px', borderRadius: '50%', background: 'radial-gradient(circle, #9CCFFF 0%, transparent 70%)', zIndex: 0 }} />

        <div style={{ position: 'relative', zIndex: 1, width: '100%', maxWidth: '460px', padding: '0 20px' }}>
          <div style={{ textAlign: 'center', marginBottom: '32px' }}>
            <span style={{ display: 'inline-block', background: '#E8E8FF', color: '#685AFF', padding: '6px 18px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', marginBottom: '14px' }}>👋 Bon retour !</span>
            <h1 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '40px', color: '#2D2D2D', marginBottom: '8px' }}>
              Se <span style={{ color: '#685AFF' }}>connecter</span>
            </h1>
            <p style={{ color: '#888', fontSize: '15px' }}>Connectez-vous pour accéder à vos cours</p>
          </div>

          {error && (
            <div style={{ background: '#FFE8E8', border: '2px solid #FF5B5B', borderRadius: '14px', padding: '14px', textAlign: 'center', marginBottom: '20px', color: '#FF5B5B', fontWeight: '600', fontSize: '14px' }}>❌ {error}</div>
          )}

          <div style={{ background: '#fff', borderRadius: '24px', boxShadow: '0 20px 60px rgba(104,90,255,0.12)', padding: '40px', border: '2px solid #F0FFC3' }}>
            <form onSubmit={handleSubmit}>
              <div style={{ marginBottom: '20px' }}>
                <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>Email</label>
                <input type="text" name="email" value={form.email} onChange={handleChange} required placeholder="votre@email.com" style={inputStyle}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
              </div>

              <div style={{ marginBottom: '28px' }}>
                <label style={{ display: 'block', fontWeight: '700', color: '#2D2D2D', marginBottom: '8px', fontSize: '14px' }}>Mot de passe</label>
                <input type="password" name="password" value={form.password} onChange={handleChange} required placeholder="••••••••" style={inputStyle}
                  onFocus={e => e.target.style.borderColor = '#685AFF'} onBlur={e => e.target.style.borderColor = '#eee'} />
              </div>

              <button type="submit" disabled={loading} style={{
                width: '100%', padding: '16px', background: loading ? '#aaa' : '#685AFF',
                color: '#fff', border: 'none', borderRadius: '50px', fontSize: '17px',
                fontFamily: "'Fredoka One', cursive", cursor: loading ? 'not-allowed' : 'pointer',
                boxShadow: '0 6px 20px rgba(104,90,255,0.35)', letterSpacing: '0.5px',
              }}>
                {loading ? '⏳ Connexion...' : '🚀 Se connecter'}
              </button>

              <p style={{ textAlign: 'center', marginTop: '20px', color: '#888', fontSize: '14px' }}>
                Pas encore inscrit ?{' '}
                <a href="/register" style={{ color: '#685AFF', fontWeight: '700', textDecoration: 'none' }}>S'inscrire ici</a>
              </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
}
import React from 'react';
import { useNavigate } from 'react-router-dom';
import { getEleve, removeEleve, isConnected } from '../auth';
import api from '../api';

export default function Navbar() {
  const navigate = useNavigate();
  const eleve = getEleve();

  const handleLogout = async () => {
    try {
      await api.post('/eleve/logout');
    } catch (e) {}
    removeEleve();
    navigate('/');
  };

  return (
    <nav style={{
      display: 'flex', justifyContent: 'space-between', alignItems: 'center',
      padding: '18px 60px', background: '#fff',
      borderBottom: '2px solid #F0FFC3',
      boxShadow: '0 2px 20px rgba(104,90,255,0.07)',
      position: 'fixed', top: 0, left: 0, right: 0, zIndex: 100,
    }}>
      <a href="/">
  <img 
    src={process.env.PUBLIC_URL + '/logo.png'} 
    alt="RS.success" 
    style={{ height: '150px', objectFit: 'contain' }} 
  />
</a>

      <ul style={{ display: 'flex', gap: '32px', listStyle: 'none', alignItems: 'center', margin: 0, padding: 0 }}>
        <li><a href="/" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>Accueil</a></li>
        <li><a href="/activites" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>Activités</a></li>

        {isConnected() ? (
          <>
            <li><a href="/cours" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>Cours</a></li>
            <li style={{ color: '#685AFF', fontWeight: '700', fontSize: '15px' }}>
              👋 {eleve?.prenom}
            </li>
            <li>
              <button onClick={handleLogout} style={{
                background: '#FF5B5B', color: '#fff', padding: '10px 24px',
                borderRadius: '50px', border: 'none', fontWeight: '700',
                fontSize: '15px', cursor: 'pointer',
                fontFamily: "'Nunito', sans-serif",
                boxShadow: '0 4px 15px rgba(255,91,91,0.3)',
              }}>
                Se déconnecter
              </button>
            </li>
          </>
        ) : (
          <>
            <li><a href="/register" style={{ textDecoration: 'none', color: '#2D2D2D', fontWeight: '600', fontSize: '15px' }}>S'inscrire</a></li>
            <li>
              <a href="/login" style={{
                background: '#685AFF', color: '#fff', padding: '10px 24px',
                borderRadius: '50px', textDecoration: 'none', fontWeight: '700', fontSize: '15px',
                boxShadow: '0 4px 15px rgba(104,90,255,0.3)',
              }}>Se connecter</a>
            </li>
          </>
        )}
      </ul>
    </nav>
  );
}
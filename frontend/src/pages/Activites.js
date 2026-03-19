import React, { useEffect, useState } from 'react';
import Navbar from '../components/Navbar';
import api from '../api';

export default function Activites() {
  const [activites, setActivites] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const link = document.createElement('link');
    link.href = 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap';
    link.rel = 'stylesheet';
    document.head.appendChild(link);

    api.get('/activites')
      .then(res => {
        setActivites(Array.isArray(res.data) ? res.data : res.data.data || []);
        setLoading(false);
      })
      .catch(() => setLoading(false));
  }, []);

  return (
    <div style={{ fontFamily: "'Nunito', sans-serif", background: '#fff', minHeight: '100vh' }}>
      <Navbar />

      {/* HEADER */}
      <div style={{ paddingTop: '100px', paddingBottom: '60px', textAlign: 'center', position: 'relative', overflow: 'hidden', background: '#FAFAFE' }}>
        <div style={{ position: 'absolute', top: '-50px', right: '-50px', width: '350px', height: '350px', borderRadius: '50%', background: 'radial-gradient(circle, #F0FFC3 0%, transparent 70%)' }} />
        <div style={{ position: 'absolute', bottom: '-50px', left: '-50px', width: '300px', height: '300px', borderRadius: '50%', background: 'radial-gradient(circle, #9CCFFF 0%, transparent 70%)' }} />
        <div style={{ position: 'relative', zIndex: 1 }}>
          <span style={{ display: 'inline-block', background: '#F0FFC3', color: '#685AFF', padding: '6px 18px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', marginBottom: '16px' }}>🎨 Nos activités</span>
          <h1 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '48px', color: '#2D2D2D', marginBottom: '12px' }}>
            Activités <span style={{ color: '#685AFF' }}>parascolaires</span>
          </h1>
          <p style={{ color: '#888', fontSize: '17px', maxWidth: '500px', margin: '0 auto' }}>
            Découvrez nos activités pour l'épanouissement de votre enfant
          </p>
        </div>
      </div>

      {/* CONTENU */}
      <div style={{ padding: '60px', maxWidth: '1200px', margin: '0 auto' }}>
        {loading && (
          <div style={{ textAlign: 'center', padding: '60px' }}>
            <div style={{ width: '50px', height: '50px', borderRadius: '50%', border: '4px solid #F0FFC3', borderTop: '4px solid #685AFF', margin: '0 auto 16px', animation: 'spin 1s linear infinite' }} />
            <style>{`@keyframes spin { to { transform: rotate(360deg); } }`}</style>
            <p style={{ color: '#888', fontWeight: '600' }}>Chargement...</p>
          </div>
        )}

        {!loading && activites.length === 0 && (
          <div style={{ textAlign: 'center', padding: '80px', background: '#FAFAFE', borderRadius: '24px' }}>
            <div style={{ fontSize: '60px', marginBottom: '16px' }}>🎭</div>
            <h3 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '26px', color: '#2D2D2D', marginBottom: '8px' }}>Aucune activité disponible</h3>
            <p style={{ color: '#888' }}>Revenez bientôt !</p>
          </div>
        )}

        {!loading && activites.length > 0 && (
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(320px, 1fr))', gap: '28px' }}>
            {activites.map((activite, i) => {
              const colors = ['#FF5B5B', '#685AFF', '#9CCFFF', '#F0FFC3'];
              const color = colors[i % colors.length];
              return (
                <div key={activite.id}
                  style={{ background: '#fff', borderRadius: '22px', boxShadow: '0 4px 24px rgba(0,0,0,0.07)', overflow: 'hidden', border: '2px solid #f5f5f5', transition: 'transform 0.2s, box-shadow 0.2s', cursor: 'pointer' }}
                  onMouseEnter={e => { e.currentTarget.style.transform = 'translateY(-6px)'; e.currentTarget.style.boxShadow = '0 16px 40px rgba(0,0,0,0.12)'; }}
                  onMouseLeave={e => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = '0 4px 24px rgba(0,0,0,0.07)'; }}
                >
                  {activite.image ? (
                    <img src={`http://localhost:8000/storage/${activite.image}`} alt={activite.titre} style={{ width: '100%', height: '220px', objectFit: 'cover' }} />
                  ) : (
                    <div style={{ width: '100%', height: '220px', background: color, display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '64px' }}>🎨</div>
                  )}
                  <div style={{ padding: '24px' }}>
                    <h3 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '24px', color: '#2D2D2D', marginBottom: '10px' }}>{activite.titre}</h3>
                    <p style={{ color: '#888', fontSize: '15px', lineHeight: '1.6', marginBottom: '16px' }}>{activite.description || 'Aucune description disponible.'}</p>
                    <div style={{ color: '#aaa', fontSize: '13px', fontWeight: '600' }}>📅 {activite.date_creation}</div>
                  </div>
                </div>
              );
            })}
          </div>
        )}
      </div>

      {/* FOOTER */}
      <footer style={{ background: '#2D2D2D', padding: '36px 60px', display: 'flex', justifyContent: 'space-between', alignItems: 'center', flexWrap: 'wrap', gap: '12px', marginTop: '40px' }}>
        <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '22px', color: '#fff' }}>RS.success</div>
        <div style={{ fontSize: '13px', color: '#aaa' }}>© 2026 RS.success — Centre de Soutien Scolaire</div>
        <div style={{ fontSize: '13px', color: '#aaa' }}>Tous droits réservés</div>
      </footer>
    </div>
  );
}
import React, { useEffect, useState } from 'react';
import Navbar from '../components/Navbar';
import api from '../api';

export default function Cours() {
  const [cours, setCours] = useState([]);
  const [niveaux, setNiveaux] = useState([]);
  const [niveauSelectionne, setNiveauSelectionne] = useState('');
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    const link = document.createElement('link');
    link.href = 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap';
    link.rel = 'stylesheet';
    document.head.appendChild(link);

    Promise.all([api.get('/cours'), api.get('/niveaux')])
      .then(([coursRes, niveauxRes]) => {
        setCours(Array.isArray(coursRes.data) ? coursRes.data : []);
        setNiveaux(Array.isArray(niveauxRes.data) ? niveauxRes.data : []);
        setLoading(false);
      }).catch(() => setLoading(false));
  }, []);

  const coursFiltres = niveauSelectionne
    ? cours.filter(c => c.classe?.niveau?.id === parseInt(niveauSelectionne))
    : cours;

  const couleurs = ['#FF5B5B', '#685AFF', '#9CCFFF', '#F0FFC3'];

  return (
    <div style={{ fontFamily: "'Nunito', sans-serif", background: '#fff', minHeight: '100vh' }}>
      <Navbar />

      {/* HEADER */}
      <div style={{ paddingTop: '220px', paddingBottom: '60px', textAlign: 'center', position: 'relative', overflow: 'hidden', background: '#FAFAFE' }}>
        <div style={{ position: 'absolute', top: '-50px', right: '-50px', width: '350px', height: '350px', borderRadius: '50%', background: 'radial-gradient(circle, #9CCFFF 0%, transparent 70%)' }} />
        <div style={{ position: 'absolute', bottom: '-50px', left: '-50px', width: '300px', height: '300px', borderRadius: '50%', background: 'radial-gradient(circle, #F0FFC3 0%, transparent 70%)' }} />
        <div style={{ position: 'relative', zIndex: 1 }}>
          <span style={{ display: 'inline-block', background: '#E8E8FF', color: '#685AFF', padding: '6px 18px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', marginBottom: '16px' }}>📚 Catalogue des cours</span>
          <h1 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '48px', color: '#2D2D2D', marginBottom: '12px' }}>
            Nos <span style={{ color: '#FF5B5B' }}>cours</span> de soutien
          </h1>
          <p style={{ color: '#888', fontSize: '17px', maxWidth: '500px', margin: '0 auto 30px' }}>
            Choisissez le cours adapté au niveau de votre enfant
          </p>
          <div style={{ display: 'flex', gap: '12px', justifyContent: 'center', flexWrap: 'wrap' }}>
            <button onClick={() => setNiveauSelectionne('')} style={{
              padding: '10px 24px', borderRadius: '50px',
              background: niveauSelectionne === '' ? '#685AFF' : '#fff',
              color: niveauSelectionne === '' ? '#fff' : '#685AFF',
              fontWeight: '700', fontSize: '14px', cursor: 'pointer',
              border: '2px solid #685AFF', fontFamily: "'Nunito', sans-serif",
            }}>Tous les niveaux</button>
            {niveaux.map(n => (
              <button key={n.id} onClick={() => setNiveauSelectionne(String(n.id))} style={{
                padding: '10px 24px', borderRadius: '50px',
                background: niveauSelectionne === String(n.id) ? '#FF5B5B' : '#fff',
                color: niveauSelectionne === String(n.id) ? '#fff' : '#FF5B5B',
                fontWeight: '700', fontSize: '14px', cursor: 'pointer',
                border: '2px solid #FF5B5B', fontFamily: "'Nunito', sans-serif",
              }}>{n.nom}</button>
            ))}
          </div>
        </div>
      </div>

      {/* CONTENU */}
      <div style={{ padding: '60px', maxWidth: '1200px', margin: '0 auto' }}>
        {loading && (
          <div style={{ textAlign: 'center', padding: '60px' }}>
            <div style={{ width: '50px', height: '50px', borderRadius: '50%', border: '4px solid #F0FFC3', borderTop: '4px solid #685AFF', margin: '0 auto 16px', animation: 'spin 1s linear infinite' }} />
            <style>{`@keyframes spin { to { transform: rotate(360deg); } }`}</style>
            <p style={{ color: '#888', fontWeight: '600' }}>Chargement des cours...</p>
          </div>
        )}

        {!loading && coursFiltres.length === 0 && (
          <div style={{ textAlign: 'center', padding: '80px', background: '#FAFAFE', borderRadius: '24px' }}>
            <div style={{ fontSize: '60px', marginBottom: '16px' }}>📭</div>
            <h3 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '26px', color: '#2D2D2D', marginBottom: '8px' }}>Aucun cours disponible</h3>
            <p style={{ color: '#888' }}>Revenez bientôt !</p>
          </div>
        )}

        {!loading && coursFiltres.length > 0 && (
          <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(320px, 1fr))', gap: '28px' }}>
            {coursFiltres.map((c, i) => {
              const color = couleurs[i % couleurs.length];
              return (
                <div key={c.id}
                  style={{ background: '#fff', borderRadius: '22px', boxShadow: '0 4px 24px rgba(0,0,0,0.07)', overflow: 'hidden', border: '2px solid #f5f5f5', transition: 'transform 0.2s, box-shadow 0.2s' }}
                  onMouseEnter={e => { e.currentTarget.style.transform = 'translateY(-6px)'; e.currentTarget.style.boxShadow = '0 16px 40px rgba(0,0,0,0.12)'; }}
                  onMouseLeave={e => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = '0 4px 24px rgba(0,0,0,0.07)'; }}
                >
                  <div style={{ background: color, padding: '28px 24px', display: 'flex', alignItems: 'center', gap: '14px' }}>
                    <div style={{ width: '54px', height: '54px', borderRadius: '16px', background: 'rgba(255,255,255,0.3)', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '28px' }}>📖</div>
                    <div>
                      <h3 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '22px', color: color === '#F0FFC3' ? '#2D2D2D' : '#fff', margin: 0 }}>{c.nom}</h3>
                      {c.duree && <span style={{ fontSize: '13px', color: color === '#F0FFC3' ? '#666' : 'rgba(255,255,255,0.8)', fontWeight: '600' }}>⏱ {c.duree}</span>}
                    </div>
                  </div>
                  <div style={{ padding: '24px' }}>
                    <p style={{ color: '#888', fontSize: '15px', lineHeight: '1.6', marginBottom: '16px' }}>{c.description || 'Cours de soutien scolaire personnalisé.'}</p>
                    <div style={{ display: 'flex', flexDirection: 'column', gap: '10px' }}>
                      {c.classe && (
                        <div style={{ display: 'flex', alignItems: 'center', gap: '8px', flexWrap: 'wrap' }}>
                          <span style={{ background: '#F0FFC3', padding: '4px 12px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', color: '#685AFF' }}>🎓 {c.classe.nom}</span>
                          {c.classe.niveau && <span style={{ background: '#E8E8FF', padding: '4px 12px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', color: '#685AFF' }}>{c.classe.niveau.nom}</span>}
                        </div>
                      )}
                      {c.planning && (
                        <div style={{ color: '#888', fontSize: '13px', fontWeight: '600' }}>
                          📅 {c.planning.jour} • {c.planning.heure_debut} - {c.planning.heure_fin}
                          {c.planning.salle && ` • 🏫 ${c.planning.salle.nom}`}
                        </div>
                      )}
                    </div>
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
import React, { useEffect, useState } from 'react';
import Navbar from '../components/Navbar';

const niveaux = [
  { icon: '🎒', title: 'Primaire', desc: '1ère à 6ème année — bases solides en maths, français et arabe', bg: '#FF5B5B', color: '#fff' },
  { icon: '📚', title: 'Collège', desc: '1ère à 3ème année — accompagnement personnalisé pour chaque matière', bg: '#685AFF', color: '#fff' },
  { icon: '🎓', title: 'Lycée', desc: 'Tronc commun & Bac — préparation intensive aux examens', bg: '#9CCFFF', color: '#2D2D2D' },
];

const services = [
  { icon: '📖', title: 'Cours de soutien', desc: 'Des cours adaptés à chaque niveau avec des enseignants qualifiés.', bg: '#F0FFC3' },
  { icon: '🏆', title: 'Préparation aux examens', desc: 'Exercices ciblés et révisions intensives pour réussir vos examens.', bg: '#FFE8E8' },
  { icon: '🎨', title: 'Activités parascolaires', desc: 'Ateliers créatifs et activités culturelles pour l\'épanouissement.', bg: '#E8E8FF' },
  { icon: '👨‍👩‍👧', title: 'Suivi des parents', desc: 'Communication régulière sur la progression de l\'élève.', bg: '#E8FFF5' },
  { icon: '🕐', title: 'Horaires flexibles', desc: 'Créneaux le matin, l\'après-midi et le week-end.', bg: '#FFF8E8' },
  { icon: '👥', title: 'Petits groupes', desc: 'Maximum 8 élèves par groupe pour un suivi personnalisé.', bg: '#F0FFC3' },
];

export default function Home() {
  const [scrolled, setScrolled] = useState(false);

  useEffect(() => {
    const link = document.createElement('link');
    link.href = 'https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@400;600;700;800&display=swap';
    link.rel = 'stylesheet';
    document.head.appendChild(link);
    const handleScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <div style={{ fontFamily: "'Nunito', sans-serif", background: '#fff' }}>
      <Navbar />

      {/* HERO */}
      <section style={{ minHeight: '100vh', background: '#fff', display: 'flex', alignItems: 'center', padding: '120px 60px 60px', position: 'relative', overflow: 'hidden' }}>
        <div style={{ position: 'absolute', top: '-80px', right: '-80px', width: '500px', height: '500px', borderRadius: '50%', background: 'radial-gradient(circle, #F0FFC3 0%, transparent 70%)', zIndex: 0 }} />
        <div style={{ position: 'absolute', bottom: '-100px', left: '-100px', width: '400px', height: '400px', borderRadius: '50%', background: 'radial-gradient(circle, #9CCFFF 0%, transparent 70%)', zIndex: 0 }} />

        <div style={{ position: 'relative', zIndex: 1, maxWidth: '600px' }}>
          <span style={{ display: 'inline-block', background: '#F0FFC3', color: '#685AFF', padding: '6px 18px', borderRadius: '50px', fontSize: '13px', fontWeight: '700', marginBottom: '20px' }}>
            🌟 Centre de Soutien Scolaire
          </span>
          <h1 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '64px', lineHeight: '1.1', color: '#2D2D2D', marginBottom: '20px' }}>
            Réussis ton<br />
            <span style={{ color: '#685AFF' }}>avenir </span>
            <span style={{ color: '#FF5B5B' }}>scolaire</span>
          </h1>
          <p style={{ fontFamily: "'Nunito', sans-serif", fontSize: '18px', color: '#666', lineHeight: '1.7', marginBottom: '40px', maxWidth: '480px' }}>
            Des cours de soutien personnalisés pour les élèves du primaire, collège et lycée. Rejoignez RS.success et progressez avec confiance !
          </p>
          <div style={{ display: 'flex', gap: '16px', flexWrap: 'wrap' }}>
            <a href="/register" style={{ background: '#685AFF', color: '#fff', padding: '14px 36px', borderRadius: '50px', textDecoration: 'none', fontWeight: '700', fontSize: '16px', boxShadow: '0 6px 20px rgba(104,90,255,0.35)', display: 'inline-block' }}>
              S'inscrire maintenant
            </a>
            <a href="/activites" style={{ background: '#fff', color: '#685AFF', padding: '14px 36px', borderRadius: '50px', textDecoration: 'none', fontWeight: '700', fontSize: '16px', border: '2px solid #685AFF', display: 'inline-block' }}>
              Voir les activités
            </a>
          </div>
        </div>

        {/* Floating Stats Card */}
        <div style={{ position: 'absolute', right: '60px', top: '50%', transform: 'translateY(-50%)', zIndex: 1, background: '#fff', borderRadius: '24px', padding: '30px', boxShadow: '0 20px 60px rgba(104,90,255,0.15)', width: '300px', border: '2px solid #F0FFC3' }}>
          <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '20px', color: '#685AFF', marginBottom: '16px' }}>📊 Nos chiffres</div>
          {[
            { icon: '👨‍🎓', bg: '#F0FFC3', num: '200+', text: 'Élèves accompagnés' },
            { icon: '📚', bg: '#FFE8E8', num: '15+', text: 'Matières enseignées' },
            { icon: '🏆', bg: '#E8E8FF', num: '95%', text: 'Taux de réussite' },
          ].map((s, i) => (
            <div key={i} style={{ display: 'flex', alignItems: 'center', gap: '12px', marginBottom: '14px' }}>
              <div style={{ width: '42px', height: '42px', borderRadius: '12px', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '20px', background: s.bg, flexShrink: 0 }}>{s.icon}</div>
              <div>
                <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '22px', color: '#2D2D2D', lineHeight: 1 }}>{s.num}</div>
                <div style={{ fontSize: '13px', color: '#888', fontWeight: '600' }}>{s.text}</div>
              </div>
            </div>
          ))}
        </div>
      </section>

      {/* NIVEAUX */}
      <section style={{ padding: '80px 60px', background: '#FAFAFE' }}>
        <h2 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '42px', color: '#2D2D2D', textAlign: 'center', marginBottom: '10px' }}>
          Nos <span style={{ color: '#685AFF' }}>niveaux</span>
        </h2>
        <p style={{ fontFamily: "'Nunito', sans-serif", fontSize: '16px', color: '#888', textAlign: 'center', marginBottom: '50px' }}>
          Un accompagnement adapté à chaque étape du parcours scolaire
        </p>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: '24px', maxWidth: '900px', margin: '0 auto' }}>
          {niveaux.map((n, i) => (
            <div key={i}
              style={{ borderRadius: '22px', padding: '36px', textAlign: 'center', background: n.bg, color: n.color, transition: 'transform 0.2s', cursor: 'pointer' }}
              onMouseEnter={e => e.currentTarget.style.transform = 'translateY(-8px)'}
              onMouseLeave={e => e.currentTarget.style.transform = 'translateY(0)'}
            >
              <div style={{ fontSize: '48px', marginBottom: '14px' }}>{n.icon}</div>
              <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '26px', marginBottom: '8px' }}>{n.title}</div>
              <div style={{ fontSize: '14px', opacity: 0.85, lineHeight: '1.5' }}>{n.desc}</div>
            </div>
          ))}
        </div>
      </section>

      {/* SERVICES */}
      <section style={{ padding: '80px 60px', background: '#fff' }}>
        <h2 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '42px', color: '#2D2D2D', textAlign: 'center', marginBottom: '10px' }}>
          Nos <span style={{ color: '#FF5B5B' }}>services</span>
        </h2>
        <p style={{ fontSize: '16px', color: '#888', textAlign: 'center', marginBottom: '50px' }}>
          Tout ce dont votre enfant a besoin pour réussir
        </p>
        <div style={{ display: 'grid', gridTemplateColumns: 'repeat(auto-fit, minmax(280px, 1fr))', gap: '24px', maxWidth: '1100px', margin: '0 auto' }}>
          {services.map((s, i) => (
            <div key={i}
              style={{ background: '#fff', borderRadius: '20px', padding: '32px', boxShadow: '0 4px 24px rgba(0,0,0,0.06)', transition: 'transform 0.2s, box-shadow 0.2s', cursor: 'pointer' }}
              onMouseEnter={e => { e.currentTarget.style.transform = 'translateY(-6px)'; e.currentTarget.style.boxShadow = '0 12px 40px rgba(0,0,0,0.1)'; }}
              onMouseLeave={e => { e.currentTarget.style.transform = 'translateY(0)'; e.currentTarget.style.boxShadow = '0 4px 24px rgba(0,0,0,0.06)'; }}
            >
              <div style={{ width: '54px', height: '54px', borderRadius: '14px', display: 'flex', alignItems: 'center', justifyContent: 'center', fontSize: '26px', marginBottom: '16px', background: s.bg }}>{s.icon}</div>
              <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '21px', color: '#2D2D2D', marginBottom: '8px' }}>{s.title}</div>
              <div style={{ fontSize: '14px', color: '#888', lineHeight: '1.6' }}>{s.desc}</div>
            </div>
          ))}
        </div>
      </section>

      {/* CTA */}
      <section style={{ background: '#685AFF', padding: '80px 60px', textAlign: 'center' }}>
        <h2 style={{ fontFamily: "'Fredoka One', cursive", fontSize: '42px', color: '#fff', marginBottom: '14px' }}>Prêt à commencer ? 🚀</h2>
        <p style={{ fontSize: '18px', color: 'rgba(255,255,255,0.85)', marginBottom: '36px' }}>
          Inscrivez votre enfant dès aujourd'hui et offrez-lui les meilleures chances de réussir !
        </p>
        <a href="/register" style={{ background: '#fff', color: '#685AFF', padding: '14px 40px', borderRadius: '50px', textDecoration: 'none', fontWeight: '700', fontSize: '16px', display: 'inline-block', boxShadow: '0 6px 20px rgba(0,0,0,0.15)' }}>
          Inscription gratuite →
        </a>
      </section>

      {/* FOOTER */}
      <footer style={{ background: '#2D2D2D', padding: '36px 60px', display: 'flex', justifyContent: 'space-between', alignItems: 'center', flexWrap: 'wrap', gap: '12px' }}>
        <div style={{ fontFamily: "'Fredoka One', cursive", fontSize: '22px', color: '#fff' }}>RS.success</div>
        <div style={{ fontSize: '13px', color: '#aaa' }}>© 2026 RS.success — Centre de Soutien Scolaire</div>
        <div style={{ fontSize: '13px', color: '#aaa' }}>Tous droits réservés</div>
      </footer>
    </div>
  );
}
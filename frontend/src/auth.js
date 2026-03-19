// Sauvegarder l'élève connecté
export const setEleve = (eleve) => {
  localStorage.setItem('eleve', JSON.stringify(eleve));
};

// Récupérer l'élève connecté
export const getEleve = () => {
  const eleve = localStorage.getItem('eleve');
  return eleve ? JSON.parse(eleve) : null;
};

// Supprimer la session
export const removeEleve = () => {
  localStorage.removeItem('eleve');
};

// Vérifier si connecté
export const isConnected = () => {
  return getEleve() !== null;
};
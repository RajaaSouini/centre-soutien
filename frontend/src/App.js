import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Home from './pages/Home';
import Activites from './pages/Activites';
import Cours from './pages/Cours';
import Login from './pages/Login';
import Register from './pages/Register';
import { isConnected } from './auth';

function PrivateRoute({ element }) {
  return isConnected() ? element : <Navigate to="/login" />;
}

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/activites" element={<Activites />} />
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/inscription" element={<Navigate to="/register" />} />
        <Route path="/cours" element={<PrivateRoute element={<Cours />} />} />
      </Routes>
    </Router>
  );
}

export default App;
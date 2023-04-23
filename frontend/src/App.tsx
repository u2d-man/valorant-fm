import Home from 'pages/Home';
import GuardedRoute from 'router/GuardedRoute';
import { BrowserRouter, Routes, Route } from 'react-router-dom';

const App = () => {
  return (
    <div className="App">
      <BrowserRouter>
        <Routes>
          <Route path='/' element={
            <GuardedRoute path='/' exact>
              <Home />
            </GuardedRoute>} />
          <Route path='/home' element={<Home />} />
        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App

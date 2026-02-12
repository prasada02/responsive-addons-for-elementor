import { Routes, Route } from 'react-router-dom';
import Dashboard from './Dashboard';
import Widgets from './Widgets';
import Settings from './Settings';
import Templates from './Templates';

const Canvas = () => {
    return (
        <Routes>
            <Route path='/' element={<Dashboard />} />
            <Route path='/widgets' element={<Widgets />} />
            <Route path='/settings' element={<Settings />} />
            <Route path='/templates' element={<Templates />} />
        </Routes>
    )
}

export default Canvas;
// Exemplos de como usar módulos JavaScript com Vite

// 1. Importar uma biblioteca externa (exemplo com Axios)
import axios from 'axios';

// 2. Importar um módulo local
import { myFunction } from './utils/helpers';

// 3. Importar CSS/SCSS dinamicamente
import('./styles/dynamic.scss');

// 4. Usar import.meta.env para variáveis de ambiente
const apiUrl = import.meta.env.VITE_API_URL || 'http://localhost:8000/api';

// 5. Importação dinâmica (lazy loading)
async function loadModule() {
    const { heavyModule } = await import('./heavy-module.js');
    return heavyModule;
}

// 6. Hot Module Replacement (HMR) para desenvolvimento
if (import.meta.hot) {
    import.meta.hot.accept('./modules/my-module.js', (newModule) => {
        // Código para lidar com atualizações do módulo
    });
}

export { apiUrl, loadModule };

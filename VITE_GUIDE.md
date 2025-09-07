# Guia do Vite no E-museu

## Comandos principais

### Desenvolvimento
```bash
npm run dev
```
Inicia o servidor de desenvolvimento do Vite com hot reload.

### Build de produção
```bash
npm run build
```
Gera os arquivos otimizados para produção na pasta `public/build/`.

## Estrutura de arquivos

### JavaScript
- `resources/js/app.js` - Arquivo principal de entrada
- `resources/js/bootstrap.js` - Configurações iniciais (Axios, Bootstrap)
- `resources/js/components/` - Componentes reutilizáveis

### CSS/SCSS
- `resources/sass/app.scss` - Arquivo principal de estilos
- `resources/sass/_variables.scss` - Variáveis do Bootstrap
- `resources/sass/_custom.scss` - Estilos customizados do projeto

## Como adicionar novos arquivos

### JavaScript
1. Crie o arquivo em `resources/js/`
2. Importe no `app.js` ou use import dinâmico
```javascript
// Import estático
import { myFunction } from './utils/helpers';

// Import dinâmico
const module = await import('./heavy-module.js');
```

### CSS/SCSS
1. Crie o arquivo em `resources/sass/`
2. Importe no `app.scss`
```scss
@import 'nova-folha-estilos';
```

## Variáveis de ambiente
Crie um arquivo `.env` na raiz com variáveis prefixadas com `VITE_`:
```env
VITE_API_URL=http://localhost:8000/api
```

Use no JavaScript:
```javascript
const apiUrl = import.meta.env.VITE_API_URL;
```

## Hot Module Replacement (HMR)
O Vite oferece HMR automático para:
- Arquivos CSS/SCSS
- Módulos JavaScript
- Templates Blade (via laravel-vite-plugin)

## Otimizações de produção
O build de produção inclui:
- Minificação de CSS e JS
- Tree shaking (remoção de código não usado)
- Code splitting automático
- Compressão de assets

## Troubleshooting

### Problema: Assets não carregam
Verifique se o servidor do Vite está rodando (`npm run dev`)

### Problema: Mudanças não são detectadas
Reinicie o servidor de desenvolvimento

### Problema: Erro de importação
Verifique os caminhos dos imports e se os arquivos existem

## Comandos úteis

```bash
# Verificar dependências desatualizadas
npm outdated

# Atualizar dependências
npm update

# Instalar nova dependência
npm install nome-do-pacote

# Instalar dependência de desenvolvimento
npm install --save-dev nome-do-pacote
```

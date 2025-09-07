import './bootstrap';

// Componentes globais
import { initAssistentButton } from './components/assistentButton';
import { initAssistentDialogueHandler } from './components/assistentDialogueHandler';
import { initImageModal, initPopoverButtons } from './components/uiComponents';

// Módulos administrativos
import { initDeleteWarnings } from './admin/deleteWarnings';

// Utilitários
import { initFormHelpers } from './utils/formHelpers';

// Inicializar todos os componentes quando o DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    // Componentes globais (sempre carregados)
    initAssistentButton();
    initAssistentDialogueHandler();
    
    // Componentes condicionais baseados na presença de elementos
    if (document.getElementById('myModal')) {
        initImageModal();
    }
    
    if (document.querySelector('[data-bs-toggle="popover"]') || document.querySelector('.info-icon')) {
        initPopoverButtons();
    }
    
    // Formulários administrativos
    if (document.querySelector('[class*="delete"][class*="Button"]')) {
        initDeleteWarnings();
    }
    
    // Helpers de formulário
    if (document.querySelector('#category_id, #component_section_id, #section_id')) {
        initFormHelpers();
    }
});

// Exportar funções para uso global se necessário
window.eMuseuApp = {
    initAssistentButton,
    initAssistentDialogueHandler,
    initImageModal,
    initPopoverButtons,
    initDeleteWarnings,
    initFormHelpers
};

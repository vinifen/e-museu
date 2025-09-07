export function initDeleteWarnings() {
    // Delete Item Tag Warning
    $(document).on('click', '.deleteItemTagButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja desassociar o item da etiqueta?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Tag Warning  
    $(document).on('click', '.deleteTagButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir esta etiqueta?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Category Warning
    $(document).on('click', '.deleteCategoryButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir esta categoria?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Extra Warning
    $(document).on('click', '.deleteExtraButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir este extra?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Item Warning
    $(document).on('click', '.deleteItemButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir este item?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete User Warning
    $(document).on('click', '.deleteUserButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir este usuário?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Proprietary Warning
    $(document).on('click', '.deleteProprietaryButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir este proprietário?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Section Warning
    $(document).on('click', '.deleteSectionButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir esta seção?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Component Warning
    $(document).on('click', '.deleteComponentButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir este componente?");
        if (!confirmation) {
            event.preventDefault();
        }
    });

    // Delete Contribution Warning
    $(document).on('click', '.deleteContributionButton', function(event) {
        const confirmation = confirm("Tem certeza que deseja excluir esta contribuição?");
        if (!confirmation) {
            event.preventDefault();
        }
    });
}

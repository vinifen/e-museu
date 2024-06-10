$(document).ready(function() {
    $(".deleteSectionButton").click(function() {
        var confirmation = confirm("Tem certeza que deseja excluir a seção e todas as vezes que é referenciada em outros registros?");

        if (!confirmation)
            event.preventDefault();
    });
});

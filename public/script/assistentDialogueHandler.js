$(document).ready(function() {
    function displayDialogue(nodeId) {
        const node = dialogues.find(d => d.id === nodeId);
        if (!node) return;

        $('#dialogue').text(node.text);
        $('#choices').empty();

        node.choices.forEach(choice => {
            const $button = $('<button></button>').text(choice.text).addClass('choice nav-link px-2 py-1 m-1 fw-bold explore-button');
            $button.on('click', function() {
                if (choice.nextId !== undefined) {
                    displayDialogue(choice.nextId);
                } else if (choice.url) {
                    window.location.href = choice.url;
                } else {
                    $('#dialogue').text("Goodbye!");
                    $('#choices').empty();
                }
            });
            $('#choices').append($button);
        });
    }

    displayDialogue(1);
});

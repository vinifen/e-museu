/**
 * Componente reutilizável para carregar items baseado em section_id
 * Usado em: item-tags/create, components/create, extras/create, extras/edit
 */
import $ from 'jquery';

$(document).ready(function() {
    // Inicializa para todos os elementos com data-section-item-selector
    $('[data-section-item-selector]').each(function() {
        const $container = $(this);
        const sectionSelector = $container.data('section-selector') || '#section_id';
        const itemSelector = $container.data('item-selector') || '#item_id';
        const originalItemId = $container.data('original-item-id') || null;
        const getItemsUrl = $container.data('get-items-url') || '/get-items';

        function getItems() {
            const sectionId = $(sectionSelector).val();
            if (!sectionId) {
                $(itemSelector).empty();
                return;
            }

            $.ajax({
                url: getItemsUrl,
                type: "GET",
                data: {
                    section: sectionId
                },
                success: function(data) {
                    $(itemSelector).empty();
                    if (Array.isArray(data) && data.length > 0) {
                        $.each(data, function(index, item) {
                            $(itemSelector).append(
                                $('<option>', {
                                    value: item.id,
                                    text: item.name
                                })
                            );
                        });
                    }
                    
                    // Seleciona o item original se fornecido
                    if (originalItemId) {
                        $(itemSelector).val(originalItemId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro ao carregar items:', error);
                }
            });
        }

        // Carrega items inicialmente
        getItems();

        // Atualiza quando section_id muda
        $(sectionSelector).on('change', function() {
            getItems();
        });
    });
});


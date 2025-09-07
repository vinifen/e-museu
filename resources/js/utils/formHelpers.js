export function initFormHelpers() {
    // Get Tags by Category
    function getTagsByCategory() {
        const categoryId = $('#category_id').val();
        if (!categoryId) return;
        
        $.ajax({
            url: "/get-tags",
            type: "GET",
            data: {category: categoryId},
            success: function(data) {
                $('#tag_id').empty();
                $.each(data, function(index, tag) {
                    $('#tag_id').append('<option value="' + tag.id + '">' + tag.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Erro ao buscar tags:', error);
            }
        });
    }

    // Get Components by Section
    function getComponentsBySection() {
        const componentSectionId = $('#component_section_id').val();
        if (!componentSectionId) return;
        
        $.ajax({
            url: "/get-items",
            type: "GET",
            data: {section: componentSectionId},
            success: function(data) {
                $('#component_id').empty();
                $.each(data, function(index, component) {
                    $('#component_id').append('<option value="' + component.id + '">' + component.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Erro ao buscar componentes:', error);
            }
        });
    }

    // Get Items by Section
    function getItemsBySection() {
        const sectionId = $('#section_id').val();
        if (!sectionId) return;
        
        $.ajax({
            url: "/get-items",
            type: "GET",
            data: {section: sectionId},
            success: function(data) {
                $('#item_id').empty();
                $.each(data, function(index, item) {
                    $('#item_id').append('<option value="' + item.id + '">' + item.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Erro ao buscar itens:', error);
            }
        });
    }

    // Initialize form helpers
    $(document).ready(function() {
        // Tags by Category
        if ($('#category_id').length && $('#tag_id').length) {
            getTagsByCategory();
            $('#category_id').on('change', getTagsByCategory);
        }

        // Components by Section  
        if ($('#component_section_id').length && $('#component_id').length) {
            getComponentsBySection();
            $('#component_section_id').on('change', getComponentsBySection);
        }

        // Items by Section
        if ($('#section_id').length && $('#item_id').length) {
            getItemsBySection();
            $('#section_id').on('change', getItemsBySection);
        }
    });
}

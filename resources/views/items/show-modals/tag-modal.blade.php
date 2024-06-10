<div class="modal fade" id="addTagModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Adicionar uma Etiqueta</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('items.store-tag') }}" method="POST" id="addTagForm">
                @csrf
                <input value="{{ $item->id }}" name="item_id" id="item-id" hidden>
                <label for="category_id">
                    <h5>Categoria da Etiqueta
                        <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="As etiquetas providenciam mais opções de categorização para os itens. Um exemplo de categoria de etiqueta seria: Marca. A que categoria a etiqueta a ser relacionada pertence?">
                            <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                        </button>
                    </h5>
                </label>
                <div class="input-div rounded-top">
                    <select class="form-select me-2 input-form" name="category_id" id="tag-category @error('category_id') is-invalid @enderror" onchange="checkIfCategoryIsEmpty()">
                        <option selected="selected" value="">-</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <label for="name">
                    <h5>Nome da Etiqueta
                        <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="O nome da etiqueta pertence à categoria de etiqueta selecionada. Seguindo essa linha de exemplo seria uma etiqueta de nome: Apple.">
                            <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                        </button>
                    </h5>
                </label>
                <div class="input-div rounded-top">
                    <input class="form-control typeahead me-2 input-form @error('name') is-invalid @enderror" type="text" name="name" id="tag-name" onchange="checkTagName()" onkeyup="checkTagName()" placeholder="" disabled>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="warning-div px-1 mx-5 mb-3" id="tag-name-warning" hidden>
                    <i class="bi bi-exclamation-circle-fill mx-1 h5"></i>Ainda não temos esta etiqueta registrada! Adicionaremos aos nossos registros após analisarmos sua sugestão.
                </div>
                <div class="col d-flex align-items-center justify-content-end">
                    <button
                        class="button nav-link py-2 px-3 fw-bold"
                        type="submit"
                        id="save-tag-button"
                    >
                        Adicionar
                    </button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button
                class="cancel-button nav-link py-2 px-3 fw-bold"
                type="button"
                data-bs-dismiss="modal"
            >
                Cancelar
            </button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    let tagNameAutoCompletePath = "{{ route('tag-name-auto-complete') }}";
    let tagCheckName = "{{ route('check-tag-name') }}";

    function checkIfCategoryIsEmpty() {
        if ($('#tag-category').find(":selected").val() == '') {
            $('#tag-name').prop('disabled', true);
            $('#tag-description').prop('disabled', true);
        } else {
            $('#tag-name').prop('disabled', false);
            $('#tag-description').prop('disabled', false);
        }
   }

   function checkTagName() {
        $.ajax({
            type: "GET",
            url: tagCheckName,
            data: {
                category: $('#tag-category').val(),
                name: $('#tag-name').val()
            },
            success: function(data) {
                if (data > 0) {
                    $('#tag-name-warning').prop("hidden", true);
                } else {
                    $('#tag-name-warning').prop("hidden", false);
                }
            }
        });
    }

   $('#tag-name').typeahead({
        source: function (query, process) {
            return $.get(tagNameAutoCompletePath, {
                query: query,
                category: $('#tag-category').find(":selected").val()
            }, function (data) {
                return process(data);
            });
        }
    });
</script>

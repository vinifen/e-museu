<div class="modal fade" id="addComponentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Adicionar um Componente</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action={{route('items.store-component') }} method="POST" id="addComponentForm">
                @csrf
                <input type="hidden" value="{{ $item->id }}" name="item_id">
                <label for="component-category">
                    <h5>Categoria do Componente
                        <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="A qual categoria, o componente a ser adicionado pertence?">
                            <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                        </button>
                    </h5>
                </label>
                <div class="input-div rounded-top">
                    <select class="form-select me-2 input-form" name="section_id" id="component-category" onchange="checkIfComponentCategoryIsEmpty()">
                        <option selected="selected" value="">-</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->name }}</option>
                        @endforeach
                    </select>
                </div>
                <label for="name">
                    <h5>Nome do Componente
                        <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="O nome do componente a ser relacionado ao item que está sendo cadastrado. Só é possível adicionar componentes que já estejão listados no nosso museu.">
                            <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                        </button>
                    </h5>
                </label>
                <div class="input-div rounded-top">
                    <input class="form-control typeahead me-2 input-form" type="text" name="component_name" id="component-name" onchange="checkComponentName()" onkeyup="checkComponentName()" placeholder="" disabled>
                </div>
                <div class="error-div px-1 mx-5 mb-3" id="component-name-warning" hidden>
                    <i class="bi bi-exclamation-circle-fill mx-1 h5"></i>Não encontramos este item nos nossos registros! O campo "Seção" e "nome" foram preenchidos corretamente?
                </div>
                <div class="col d-flex align-items-center justify-content-end">
                    <button
                        class="button nav-link py-2 px-3 fw-bold"
                        type="submit"
                        id="save-component-button"
                        disabled
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
    let componentNameAutoCompletePath = "{{ route('component-name-auto-complete') }}";
    let componentCheckName = "{{ route('check-component-name') }}";

   function checkIfComponentCategoryIsEmpty() {
        if ($('#component-category').find(":selected").val() == '') {
            $('#component-name').prop('disabled', true);
            $('#component-description').prop('disabled', true);
        } else {
            $('#component-name').prop('disabled', false);
            $('#component-description').prop('disabled', false);
        }
   }

   function checkComponentName() {
        $.ajax({
            type: "GET",
            url: componentCheckName,
            data: {
                category: $('#component-category').val(),
                name: $('#component-name').val()
            },
            success: function(data) {
                if (data > 0) {
                    $('#component-name-warning').prop("hidden",true);
                    $('#save-component-button').prop("disabled",false);
                    return;
                } else {
                    $('#component-name-warning').prop("hidden",false);
                    $('#save-component-button').prop("disabled",true);
                    return;
                }
            }
        });
   }

   $('#component-name').typeahead({
        source: function (query, process) {
            return $.get(componentNameAutoCompletePath, {
                category: $('#component-category').find(":selected").val()
            }, function (data) {
                return process(data);
            });
        }
    });
</script>

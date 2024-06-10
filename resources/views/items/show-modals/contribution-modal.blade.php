<div class="modal fade" id="addContributionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Agregar Conteúdo</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('items.store-contribution') }}" method="POST" id="addContributionForm">
                @csrf
                <input name="item_id" value="{{ $item->id }}" hidden>
                <label for="info">
                    <h5>Conteúdo
                        <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Está faltando alguma informação sobre esse item? Por favor, compartilhe esta informação conosco!">
                            <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                        </button>
                    </h5>
                </label>
                <div class="input-div rounded-top">
                    <textarea class="form-control me-2 input-form @error('content') is-invalid @enderror" type="text" name="content" id="content" placeholder="" rows="30" required></textarea>
                </div>
                <div>
                    <label for="e-mail">
                        <h5>E-mail
                            <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Por favor forneça-nos seu e-mail para que possamos entrar em contato no futuro, caso seja necessário.">
                                <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                            </button>
                        </h5>
                    </label>
                    <div class="input-div">
                        <input
                            class="form-control me-2 input-form  @error('contact') is-invalid @enderror"
                            type="email"
                            name="contact"
                            id="contribution-contact"
                            placeholder=""
                            value="{{ old('contact') }}"
                            onchange="checkContributionContact()"
                            onkeyup="checkContributionContact()"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="warning-div px-1 mx-5 mb-3" id="contribution-contact-warning" hidden>
                        <i class="bi bi-exclamation-circle-fill mx-1 h5"></i>Proprietário não encontrado! Adicionaremos aos nossos registros para futuras contribuições.
                    </div>
                    <div class="success-div px-1 mx-5 mb-3" id="contribution-contact-success" hidden>
                        <i class="bi bi-exclamation-circle-fill mx-1 h5"></i>Proprietário encontrado. Bem vindo de volta!
                    </div>
                </div>
                <div>
                    <label for="full_name">
                        <h5>Nome Completo
                            <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1" data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus" data-bs-content="Por favor, informe seu nome completo. Precisamos dessas informações para que possamos creditá-lo quando esta informação for disponibilizada para exibição em nosso museu.">
                                <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                            </button>
                        </h5>
                    </label>
                    <div class="input-div">
                        <input
                            class="form-control me-2 input-form  @error('full_name') is-invalid @enderror"
                            type="text"
                            name="full_name"
                            id="contribution-full_name"
                            placeholder=""
                            value="{{ old('full_name') }}"
                            required
                        >
                        @error('full_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col d-flex align-items-center justify-content-end">
                    <button
                        class="button nav-link py-2 px-3 fw-bold"
                        type="submit"
                        id="save-extra-button"
                    >
                        Enviar
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

  <script>
    function checkContributionContact() {
            $.ajax({
                type: "GET",
                url: checkContactRoute,
                data: {
                    contact: $('#contribution-contact').val()
                },
                success: function(data) {
                    if (data == false) {
                        $('#contribution-contact-warning').prop("hidden",false);
                        $('#contribution-contact-success').prop("hidden",true);
                        return;
                    } else {
                        if ($('#contribution-contact').val() != '') {
                            $('#contribution-contact-warning').prop("hidden",true);
                            $('#contribution-contact-success').prop("hidden",false);
                            $('#contribution-full_name').val(data.full_name);
                        } else {
                            $('#contribution-contact-success').prop("hidden",true);
                            $('#contribution-contact-warning').prop("hidden",true);
                        }
                        return;
                    }
                }
            });
        }
  </script>

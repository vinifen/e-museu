<div class="modal fade" id="addExtraModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar uma Informação Extra</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('items.store-extra') }}" method="POST" id="addExtraForm">
                    @csrf
                    <input name="item_id" value="{{ $item->id }}" hidden>
                    <label for="info">
                        <h5>Informação Extra
                            <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1"
                                data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus"
                                data-bs-content="Possui alguma informação adicional ou curiosidade sobre o item que gostaria de compartilhar? Por favor, nos informe por aqui.">
                                <i class="bi bi-info-circle-fill h4 ms-1" style="color: #ED6E38; cursor: pointer;"></i>
                            </button>
                        </h5>
                    </label>
                    <div class="input-div rounded-top">
                        <textarea class="form-control me-2 input-form @error('info') is-invalid @enderror" type="text" name="info"
                            id="info" placeholder="" rows="15" required></textarea>
                    </div>
                    <div>
                        <label for="e-mail">
                            <h5>E-mail
                                <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1"
                                    data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus"
                                    data-bs-content="Por favor forneça-nos seu e-mail para que possamos entrar em contato no futuro, caso seja necessário.">
                                    <i class="bi bi-info-circle-fill h4 ms-1"
                                        style="color: #ED6E38; cursor: pointer;"></i>
                                </button>
                            </h5>
                        </label>
                        <div class="input-div">
                            <input class="form-control me-2 input-form  @error('contact') is-invalid @enderror"
                                type="email" name="contact" id="contact" placeholder="" value="{{ old('contact') }}"
                                onchange="checkContact()" onkeyup="checkContact()" required>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="warning-div px-1 mx-5 mb-3" id="contact-warning" hidden>
                            <i class="bi bi-exclamation-circle-fill mx-1 h5"></i>Colaborador não encontrado!
                            Adicionaremos aos nossos registros para futuras contribuições.
                        </div>
                        <div class="success-div px-1 mx-5 mb-3" id="contact-success" hidden>
                            <i class="bi bi-exclamation-circle-fill mx-1 h5"></i>Colaborador encontrado. Bem vindo de
                            volta!
                        </div>
                    </div>
                    <div>
                        <label for="full_name">
                            <h5>Nome Completo
                                <button type="button" class="info-icon btn border-0 bg-transparent px-0 py-0 mb-1"
                                    data-bs-toggle="popover" data-bs-placement="top" data-bs-trigger="focus"
                                    data-bs-content="Por favor, informe seu nome completo. Precisamos dessas informações para que possamos creditá-lo quando seu item for disponibilizado para exibição em nosso museu.">
                                    <i class="bi bi-info-circle-fill h4 ms-1"
                                        style="color: #ED6E38; cursor: pointer;"></i>
                                </button>
                            </h5>
                        </label>
                        <div class="input-div">
                            <input class="form-control me-2 input-form  @error('full_name') is-invalid @enderror"
                                type="text" name="full_name" id="full_name" placeholder=""
                                value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col d-flex align-items-center justify-content-end">
                        <button class="button nav-link py-2 px-3 fw-bold" type="submit" id="save-extra-button">
                            Enviar
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="cancel-button nav-link py-2 px-3 fw-bold" type="button" data-bs-dismiss="modal">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function checkContact() {
        $.ajax({
            type: "GET",
            url: checkContactRoute,
            data: {
                contact: $('#contact').val()
            },
            success: function(data) {
                if (data == false) {
                    $('#contact-warning').prop("hidden", false);
                    $('#contact-success').prop("hidden", true);
                    return;
                } else {
                    if ($('#contact').val() != '') {
                        $('#contact-warning').prop("hidden", true);
                        $('#contact-success').prop("hidden", false);
                        $('#full_name').val(data.full_name);
                    } else {
                        $('#contact-success').prop("hidden", true);
                        $('#contact-warning').prop("hidden", true);
                    }
                    return;
                }
            }
        });
    }
</script>

@extends('layouts.admin')
@section('title', 'Editar informação extra ' . $extra->id)

@section('content')
    <div class="mb-auto container-fluid">
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                {{ $error }}
            </div>
        @endforeach
        <form action="{{ route('admin.extras.update', $extra->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-3">
                        <h2 class="card-header">Editar Curiosidade Extra: {{ $extra->id }}</h2>
                    </div>
                    <div class="mb-3">
                        <label for="info" class="form-label">Curiosidade</label>
                        <textarea type="text" class="form-control @error('info') is-invalid @enderror" id="info" name="info"
                            rows="5">{{ $extra->info }}</textarea>
                        @error('info')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="section_id" class="form-label">Categoria do Item</label>
                                <select class="form-select @error('section_id') is-invalid @enderror" id="section_id"
                                    name="section_id">
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"
                                            {{ $extra->item->section->id == $section->id ? 'selected' : '' }}>
                                            {{ $section->name }}</option>
                                    @endforeach
                                </select>
                                @error('section_id')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="item_id" class="form-label">Item</label>
                                <select class="form-select @error('item_id') is-invalid @enderror" id="item_id"
                                    name="item_id">
                                </select>
                                @error('item_id')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="proprietary_id" class="form-label">Proprietário</label>
                        <select class="form-select @error('proprietary_id') is-invalid @enderror" id="proprietary_id"
                            name="proprietary_id">
                            @foreach ($proprietaries as $proprietary)
                                <option value="{{ $proprietary->id }}"
                                    {{ $extra->proprietary->id == $proprietary->id ? 'selected' : '' }}>
                                    {{ $proprietary->contact }}</option>
                            @endforeach
                        </select>
                        @error('proprietary_id')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="validation" class="form-label">Validado</label>
                        <select class="form-select @error('validation') is-invalid @enderror" id="validation"
                            name="validation">
                            <option value="0" {{ $extra->validation == 0 ? 'selected' : '' }}>Não</option>
                            <option value="1" {{ $extra->validation == 1 ? 'selected' : '' }}>Sim</option>
                        </select>
                        @error('validation')
                            <div class="invalid-feedback"> {{ $message }} </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning"><i class="bi bi-pencil-fill"></i> Enviar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            function getItems() {
                var sectionId = $('#section_id').val();
                $.ajax({
                    url: "/get-items",
                    type: "GET",
                    data: {
                        section: sectionId
                    },
                    success: function(data) {
                        $('#item_id').empty();
                        $.each(data, function(index, item) {
                            $('#item_id').append('<option value="' + item.id + '">' + item
                                .name + '</option>');
                        });
                        selectOriginalItem();
                    }
                });
            }

            getItems();

            $('#section_id').on('change', function() {
                getItems();
            });

            function selectOriginalItem() {
                var originalItemId = {{ $extra->item->id }};
                $('#item_id').val(originalItemId);
            }
        });
    </script>
@endsection

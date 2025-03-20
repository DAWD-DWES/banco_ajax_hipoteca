<div class="container mt-4">
    <form action="{{ $actionUrl }}" method="POST">
        <div class="mb-3">
            <div class="input-group">
                <button class="btn btn-outline-success" type="submit" name="{{ $info }}">
                    <i class="bi bi-search"></i>
                </button>
                <input class="form-control {{ ($err ? "is-invalid" : "") }}" 
                       type="search" placeholder="{{ $placeholder }}" value="{{$valor}}"
                       aria-label="Search" name="{{ $fieldName }}">
                <div class="invalid-feedback">
                     El {{ $fieldName }} no existe
                </div>
            </div>
        </div>
    </form>
</div>



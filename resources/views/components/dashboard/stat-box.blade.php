<div class="col-md-4 mb-3">
    <div class="card card-stats shadow-sm border-start border-4 border-{{ $color }}">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p class="card-category text-{{ $color }} fw-bold">{{ $title }}</p>
                <h4 class="card-title">{{ $value }}</h4>
            </div>
            <div class="icon-big text-center text-{{ $color }}">
                <i class="nc-icon {{ $icon }}"></i>
            </div>
        </div>
    </div>
</div>

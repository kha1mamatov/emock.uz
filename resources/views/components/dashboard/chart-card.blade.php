@props([
    'col' => '12',
    'canvasId' => '',
    'title' => '',
    'icon' => 'nc-icon nc-chart-bar-32 text-primary',
    'subtitle' => '',
])

<div class="col-md-{{ $col }} mt-4">
    <div class="card card-chart">
        <div class="card-header">
            <h5 class="card-title">
                <i class="{{ $icon }}"></i> {{ $title }}
            </h5>
            <p class="card-category">{{ $subtitle }}</p>
        </div>
        <div class="card-body">
            <canvas id="{{ $canvasId }}" height="100"></canvas>
        </div>
    </div>
</div>

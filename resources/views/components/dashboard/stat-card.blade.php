@props([
    'icon' => 'nc-icon nc-chart-bar-32',
    'color' => 'info',
    'title' => '',
    'value' => '',
    'footer' => '',
    'footerIcon' => 'fa-clock-o',
])

<div class="card card-stats">
    <div class="card-body">
        <div class="row">
            <div class="col-5 text-center">
                <div class="icon-big text-{{ $color }}">
                    <i class="nc-icon {{ $icon }}"></i>
                </div>
            </div>
            <div class="col-7">
                <div class="numbers">
                    <p class="card-category">{{ $title }}</p>
                    <p class="card-title">{{ $value }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <hr />
        <div class="stats">
            <i class="fa {{ $footerIcon }}"></i> {{ $footer }}
        </div>
    </div>
</div>

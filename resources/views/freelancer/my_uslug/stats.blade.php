@extends('layout.app')

@section('title-block', 'Статистика услуг')

@section('main_content')
<div class="container">
    <h1>Статистика услуг</h1>
    <ul>
        <li>Общий доход: {{ $totalIncome }} ₽</li>
        <li>Количество услуг: {{ $serviceCount }}</li>
        <li>Популярные услуги:
            <ul>
                @foreach ($popularServices as $service)
                    <li>{{ $service->title }} ({{ $service->formatted_price }})</li>
                @endforeach
            </ul>
        </li>
    </ul>

    <canvas id="incomeChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('incomeChart').getContext('2d'), {
    type: 'bar',
    data: {
        labels: @json($popularServices->pluck('title')),
        datasets: [{
            label: 'Доход от услуг',
            data: @json($popularServices->pluck('price')),
            backgroundColor: 'rgba(75,192,192,0.2)',
            borderColor: 'rgba(75,192,192,1)',
            borderWidth: 1
        }]
    },
    options: { responsive: true }
});
</script>
@endsection
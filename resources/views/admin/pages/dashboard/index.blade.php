@extends('layouts.admin.admin')

@section('content-title', 'Dashboard')

@section('content-body')
    @if($drain)
        <div class="card">
            <div class="card-body">
                <span>Air terakhir di kuras pada tanggal: &nbsp;&nbsp; <b>{{ $drain->created_at->format('d F Y, H:i:s') }}</b></span>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="border-bottom: 3px solid rgb(75, 192, 192);">
                <div class="card-header">
                    <h4 style="display: block;">Temperatur saat ini : </h4>
                </div>
                <div class="card-body text-center">
                    <h2 style="font-size: 60px;"><span id="temperature">{{ $temperature }}</span><span>°</span></h2>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="card" style="border-bottom: 3px solid rgb(75,94,192);">
                <div class="card-header">
                    <h4>PH Air saat ini :</h4>
                </div>
                <div class="card-body text-center">
                    <h2 style="font-size: 60px;"><span id="ph">{{ $ph }}</span></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Selamat datang di dashboard aquarium.</h4>
                    <form method="post" action="{{ route('mosquittos.store') }}" class="card-header-action">
                        @csrf
                        <button class="btn btn-primary"><i class="fa fa-tint"></i> Kuras Air</button>
                    </form>
                </div>
                <div class="card-body">
                    @if($message = session('success'))
                        <x-alert.success :message="$message"></x-alert.success>
                    @endif
                    <canvas id="chart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="dataset" value='@json($details)'>
    <input type="hidden" id="temperatures" value='@json($temperatures)'>
    <input type="hidden" id="phs" value='@json($phs)'>
    <input type="hidden" id="dates" value='@json($dates)'>
@endsection

@push('stack-script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.min.js" integrity="sha512-CQBWl4fJHWbryGE+Pc7UAxWMUMNMWzWxF4SQo9CgkJIN1kx6djDQZjh3Y8SZ1d+6I+1zze6Z7kHXO7q3UyZAWw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const ctx = document.getElementById('chart');
        const details = JSON.parse(document.getElementById('dataset').value);
        const temperatures = JSON.parse(document.getElementById('temperatures').value);
        const phs = JSON.parse(document.getElementById('phs').value);
        const dates = JSON.parse(document.getElementById('dates').value);

        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [
                    {
                        label: 'Temperatur',
                        data: temperatures,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.5
                    },
                    {
                        label: 'PH air',
                        data: phs,
                        fill: false,
                        borderColor: 'rgb(75,94,192)',
                        tension: 0.5
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        // max: 100
                    },
                    x: {
                        ticks: {
                            maxTicksLimit: 8,
                        },
                        // reverse: true,
                    },
                },
                animations: false,
                // animations: {
                //     x: {
                //         duration: 3000,
                //         from: 0
                //     },
                // },
            }
        });
    </script>
    <script>
        const interval = setInterval(() => {
            $.ajax({
                url: '{{ route('api.details.index') }}',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    chart.data.labels = data.data.dates;
                    chart.data.datasets[0].data = data.data.temperatures;
                    chart.data.datasets[1].data = data.data.phs;
                    chart.update();

                    if (data.data.temperatures.length) {
                        document.getElementById('temperature').innerHTML = data.data.temperatures[0];
                    }
                    if (data.data.phs.length) {
                        document.getElementById('ph').innerHTML = data.data.phs[0];
                    }
                }
            });
        }, 5000); // 5000 milliseconds = 5 seconds
    </script>
@endpush

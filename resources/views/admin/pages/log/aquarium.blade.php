@extends('layouts.admin.admin')

@section('content-title', 'Log Aquarium')

@section('content-body')
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Log Aquarium</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive mb-3">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Temperatur</th>
                            <th>Ph</th>
                            <th>Waktu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($details as $detail)
                            <tr>
                                <td>
                                    <x-iterate :pagination="$details" :loop="$loop"></x-iterate>
                                </td>
                                <td>{{ $detail->temperature }}</td>
                                <td>{{ $detail->ph }}</td>
                                <td>
                                    {{ $detail->created_at->format('d F Y, H:i:s') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" style="text-align: center;">Data Empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $details->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

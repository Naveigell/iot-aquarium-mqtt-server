@extends('layouts.admin.admin')

@section('content-title', 'Log Pengurasan')

@section('content-body')
    <div class="col-lg-12 col-md-12 col-12 col-sm-12 no-padding-margin">
        <div class="card">
            <div class="card-header">
                <h4>Log Pengurasan</h4>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive mb-3">
                    <table class="table table-striped mb-0">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Waktu</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($drains as $drain)
                            <tr>
                                <td>
                                    <x-iterate :pagination="$drains" :loop="$loop"></x-iterate>
                                </td>
                                <td>
                                    {{ $drain->created_at->format('d F Y, H:i:s') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" style="text-align: center;">Data Empty</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center">
                    {{ $drains->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

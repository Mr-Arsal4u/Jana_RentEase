@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h4>Currencies</h4>
                            <button class="btn mb-1 btn-rounded btn-outline-primary" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="@mdo">Create</button>
                        </div>
                        @include('admin.currency.modal')
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($currencies as $currency)
                                        <tr>
                                            <td>{{ $currency->code }}</td>
                                            <td class="color-primary">{{ $currency->name }}</td>
                                            <td>
                                                <span class="badge {{ $currency->status == 'active' ? 'badge-success' : 'badge-danger' }} px-2">
                                                    {{ ucfirst($currency->status) }}
                                                </span>
                                            </td>
                                            <td>{{ \App\Helpers\GeneralHelper::formatDate($currency->created_at) }}</td>
                                            <td>
                                                <span>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Edit" data-original-title="Edit">
                                                        <i class="fa fa-pencil color-muted m-r-5"></i>
                                                    </a>
                                                    <a href="#" data-toggle="tooltip" data-placement="top"
                                                        title="Delete" data-original-title="Delete">
                                                        <i class="fa fa-trash color-danger"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5">Nothing To See Here!</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

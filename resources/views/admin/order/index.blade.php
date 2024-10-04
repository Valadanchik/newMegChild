@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xxl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="shopping-cart"></i></div>
                                Orders
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card mb-4">
                <div class="card-header">Authors list</div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Notify</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Notify</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $index => $order)
                            <tr>
                                <td>{{ $order['id']  }}</td>
                                <td>{{ $order['order_payment_id']  }}</td>
                                <td>{{ $order['name']  }}</td>
                                <td>{{ $order['created_at']  }}</td>
                                <td>
                                    @switch($order['payment_method'])
                                        @case(\App\Models\Order::PAYMENT_METHOD_BANK)
                                            <img src="{{ URL::to('images/svg/arca.svg') }}" alt="arca logo">
                                            @break
                                        @case(\App\Models\Order::PAYMENT_METHOD_IDRAM)
                                            <img src="{{ URL::to('images/svg/idram.svg') }}" alt="idram logo">
                                            @break
                                        @case(\App\Models\Order::PAYMENT_METHOD_TELCELL)
                                            <img src="{{ URL::to('images/svg/telcell.svg') }}" alt="telcell logo">
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    @switch($order['status'])
                                        @case(\App\Models\Order::STATUS_NEW)
                                            <span class="badge badge-warning">Չմշակված</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_PROCESSING)
                                            <span class="badge badge-primary">Մշակվում է</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_COMPLETED)
                                            <span class="badge badge-success">Կատարված</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_FAILED)
                                            <span class="badge badge-danger">Մերժված</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_RETURNED)
                                            <span class="badge badge-danger">Վերադարձված</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <button data-route="{{ route('orders.notifyAdmin', $order['id']) }}"
                                            class="notifyAdmin badge badge-primary p-2 border-0"><i
                                                class="bi bi-envelope me-1"></i>
                                        Admin
                                    </button>
                                    <button data-route="{{ route('orders.notifyUser', $order['id']) }}"
                                            class="notifyUser badge badge-primary p-2 border-0"><i
                                                class="bi bi-envelope me-1"></i>
                                        User
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order['id']) }}"
                                       class="badge badge-warning p-2"> <i class="bi bi-eye me-1"></i> Show</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('body-scripts')
    <script>
        $(document).on('click', '.notifyUser', function () {
            let route = $(this).data('route');
            if (confirm('Are you sure?')) {
                window.location.href = route;
            }
        });
        $(document).on('click', '.notifyAdmin', function () {
            let route = $(this).data('route');
            if (confirm('Are you sure?')) {
                window.location.href = route;
            }
        });
    </script>
@endpush

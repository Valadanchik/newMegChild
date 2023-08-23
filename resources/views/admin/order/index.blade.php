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
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Shipping status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Payment Method</th>
                            <th>Shipping status</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($orders as $index => $order)
                            <tr>
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
                                    @switch($order['payment_status'])
                                        @case(\App\Models\Order::STATUS_NEW)
                                            <span>Չմշակված</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_PROCESSING)
                                            <span>Ընթացքում</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_COMPLETED)
                                            <span>Առաքված</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_FAILED)
                                            <span>Մերժված</span>
                                            @break
                                        @case(\App\Models\Order::STATUS_RETURNED)
                                            <span>Վերադարձված</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>
                                    <a href="{{ route('orders.show', $order['id']) }}" class="'bi bi-eye btn btn-datatable btn-icon btn-transparent-dark me-2"><i class="fa-regular fa-eye"></i></a>
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

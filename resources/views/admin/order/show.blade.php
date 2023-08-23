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
                                Order #{{ $order['order_payment_id']  }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    <div>
                        <h3>Order Info։</h3>
                        <p><strong>ID:</strong> <span>#{{ $order->order_payment_id }}</span></p>
                        <p><strong>DATE:</strong> <span>{{ $order->created_at }}</span></p>
                        <p><strong>STATUS:</strong> {{ $order->status ? 'Վճարված պատվեր' : 'Չվճարված պատվեր' }}</p>
                        <p><strong>SHIPPING STATUS:</strong>
                            @switch($order->payment_status)
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
                        </p>
                        <p><strong>PAYMENT METHOD:</strong>
                            @switch($order->payment_method)
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
                        </p>
                        <p><strong>TOTAL PRICE:</strong> {{ $order->total_price }}</p>
                    </div>
                    <hr>
                    <div>
                        <h3>Customer Info։</h3>
                        <p><strong>NAME:</strong> <span>{{ $order->name }}</span></p>
                        <p><strong>PHONE:</strong> <span>{{ $order->phone }}</span></p>
                        <p><strong>EMAIL:</strong> <span>{{ $order->email }}</span></p>
                    </div>
                    <hr>

                    <div>
                        <h3>Shipping Info։</h3>
                        <p><strong>COUNTRY:</strong> <span>{{ $order->country->name_hy }}</span></p>
                        <p><strong>STREET:</strong> <span>{{ $order->street }}</span></p>
                        <p><strong>HOUSE:</strong> <span>{{ $order->house }}</span></p>
                        <p><strong>POSTAL CODE:</strong> <span>{{ $order->postal_code }}</span></p>
                    </div>
                </div>

            </div>
            <div class="card mb-4">
                <div class="card-body order_books">
                    <h3>Books</h3>

                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->books as $index => $book)
                            <tr>
                                <td>
                                    <img width="200px" src="{{ URL::to('storage/' . $book['main_image']) }}" alt="">
                                </td>
                                <td>{{ $book['title_' . app()->getLocale()]  }}</td>
                                <td>{{ $book['price'] }} ֏</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
@endsection

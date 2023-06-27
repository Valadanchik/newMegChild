@extends('admin.layout.layout')

@section('admin.content')
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="users"></i></div>
                                Coupons
                            </h1>
                            <div class="page-header-subtitle mt-4"><a href="{{ url('fs-admin/coupons/create ') }}" class="btn btn-outline-light" type="button">+ Add new coupon</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
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
                <div class="card-header">Coupons list</div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                        <tr>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Books</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Code</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Type</th>
                            <th>Books</th>
                            <th>Actions</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($coupons as $index => $coupon)
                            <tr>
                                <td>{{ $coupon['code']  }}</td>
                                <td>{{ $coupon['price']  }}</td>
                                <td>{{ $coupon['quantity']  }}</td>
                                <td>{{ $coupon['type'] }}</td>
                                <td>{{ $coupon['book_id'] === \App\Models\Coupon::ALL_BOOKS ? 'All Books' :  implode(', ', json_decode($coupon['book_id']))  }}</td>
                                <td>
                                    <a href="{{ url('fs-admin/coupons/' . $coupon['id'] . '/edit' ) }}" class="btn btn-datatable btn-icon btn-transparent-dark me-2">
                                        <i class="fa-regular fa-edit"></i>
                                    </a>
                                    <form style="display: inline-block" action="{{ route('coupons.destroy', $coupon['id']) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-datatable btn-icon btn-transparent-dark me-2" type="submit" onclick="return confirm('Are you sure you want to delete this model?')"> <i class="fa-regular fa-trash-can"></i></button>
                                    </form>
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

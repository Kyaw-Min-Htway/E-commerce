@extends('admin.layouts.master')

@section('title', 'Message List')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="overview-wrap">
                            <h2 class="title-1">Message List</h2>

                        </div>
                    </div>
                </div>
                @if (session('info'))
                    <div class="alert alert-primary">
                        {{session('info')}}
                    </div>
                @endif

                   {{-- <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary"> Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('category#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Search..." name="key" value="{{ request('key') }}">
                                <button class="btn btn-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                   </div> --}}

                   {{-- <div class="row my-2">
                    <div class="col-5">
                        <h3 class="text-secondary">Total - {{ $data->total() }}</h3>
                    </div>
                   </div> --}}

               @if (count($data) != 0)
               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Email</th>
                            <th>Message</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $d)
                        <tr class="tr-shadow">
                            <td>{{ $d->name }}</td>
                            <td>{{ $d->email }}</td>
                            <td>{{ $d->message }}</td>
                            <td>{{ $d->created_at->format('j-F-Y') }}</td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>

                {{-- <div class="mt-3">
                    {{ $data->links() }}
                </div> --}}
            </div>
                @else
                <h3 class="text-secondary text-center mt-5">There is no message!</h3>
               @endif
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection

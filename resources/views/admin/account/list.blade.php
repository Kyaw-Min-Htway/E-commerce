@extends('admin.layouts.master')

@section('title', 'Admin List')

@section('content')

<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <div class="">
                            <h2 class="title-1">User List</h2>
                        </div>
                    </div>
                    <div class="table-data__tool-right">
                        <div class="btn btn-secondary">
                           <a href="{{route('export#user')}}"> <h2 class="title-1">Exports</h2></a>
                        </div>
                    </div>
                </div>
                @if (session('info'))
                    <div class="alert alert-success">
                        {{session('info')}}
                    </div>
                @endif

                   <div class="row">
                    <div class="col-3">
                        <h4 class="text-secondary"> Search Key : <span class="text-danger">{{ request('key') }}</span></h4>
                    </div>
                    <div class="col-3 offset-6">
                        <form action="{{ route('admin#list')}}" method="get">
                            @csrf
                            <div class="d-flex">
                                <input type="text" class="form-control" placeholder="Search..." name="key" value="{{ request('key') }}">
                                <button class="btn btn-dark text-white" type="submit">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                   </div>

                   <div class="row my-2">
                    <div class="col-5">
                        <h3><i class="fa-solid fa-database mr-2"></i>{{ $admin->total() }}</h3>
                    </div>
                   </div>

               <div class="table-responsive table-responsive-data2">
                <table class="table table-data2 text-center">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $a)
                        <tr class="tr-shadow">
                            <td class="col-2">
                                @if ($a->image)
                                <img src="{{ asset('storage/'. $a->image) }}" alt="" class="img-thumbnail shadow-sm"></td>
                                @else
                                @if ($a->gender == 'male')
                                <img src="{{ asset('image/user_profile.png')}}" class="img-thumbnail shadow-sm"/>
                                @else
                                <img src="{{ asset('image/images.png')}}" class="img-thumbnail shadow-sm"/>
                                @endif
                                @endif
                            <td class="col-2">{{ $a->name }}</td>
                            <td class="col-2">{{ $a->phone }}</td>
                            <td class="col-2">{{ $a->email }}</td>
                            <td class="col-2">{{ $a->role }}</td>
                            <td class="col-2">
                                <div class="table-data-feature">
                                     @if (Auth::user()->id != $a->id)
                                     <a href="{{route('role#change',$a->id)}}" class="col">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Admin Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </button>
                                       </a>
                                    @endif
                                    @if (Auth::user()->id != $a->id)
                                    <a href="{{route('admin#delete',$a->id)}}" class="col">
                                        <button class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                        <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        @endforeach
                        </tr>
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $admin->links() }}
                </div>
            </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->

@endsection

 @extends('backend.admin.layouts.master', ['page_slug' => 'admin'])
 @section('title', 'Admin List - ')
 @section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{__('Admin List')}}</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>{{__('SL')}}</th>
                                    <th>{{__('Name')}}</th>
                                    <th>{{__('Email')}}</th>
                                    <th>{{__('Status')}}</th>
                                    <th>{{__('Created Date')}}</th>
                                    <th>{{__('Created By')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$admin->name}}</td>
                                        <td>{{$admin->email}}</td>
                                        <td>
                                            <span class="badge {{$admin->status == 1 ? 'bg-success' : 'bg-danger'}}">{{$admin->status == 1 ? 'Active' : 'Inactive'}}</span>
                                        </td>
                                        <td>{{date('d-m-Y', strtotime($admin->created_at))}}</td>
                                        <td>{{$admin->createdBy ? $admin->createdBy->name : 'System'}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



 @endsection


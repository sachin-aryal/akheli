@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        $('#user_list').DataTable();
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <h1>User List</h1>
            <table class="table" id="user_list">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Shop Name</th>
                    <th>User Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->clientId->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->clientId->shop_name}}</td>
                    <td>{{$user->roles->first->name->name}}</td>
                    <td>
                        <form action="/user/status" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{$user->id}}" name="user_id"/>
                            <button type="submit">
                                @if ($user->enabled)
                                    Disable
                                @else
                                    Enable
                                @endif
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

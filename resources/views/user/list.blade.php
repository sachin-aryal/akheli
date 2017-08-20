@extends('layouts.app')

@section('content')
<script type="text/javascript">
    $(document).ready(function(){
        $('#user_list').DataTable();
    });
</script>
<div class="col-lg-offset-4 col-lg-4l">
    <h1>User List</h1>

    <table class="display" id="user_list">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Shop Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{$user->clientId->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->clientId->shop_name}}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

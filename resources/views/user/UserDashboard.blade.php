@extends('layouts.app')

@section('content')

    @role('admin')
        <p>I'm Admin</p>
    @endrole

    @role('user')
        <p>I'm User</p>
    @endrole

    @role('editor')
        <p>I'm Editor</p>
    @endrole

@endsection
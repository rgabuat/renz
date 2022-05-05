@extends('layouts.app')

@section('title',"Dashboard")

@section('content')

    @role('system-admin')
        <p>I'm a Systen Admin</p>
    @endrole

    @role('system-editor')
        <p>I'm Editor</p>
    @endrole

    @role('system-user')
        <p>I'm system user</p>
    @endrole

    @role('company-admin')
        <p>I'm User</p>
    @endrole

    @role('company-user')
        <p>I'm Company user</p>
    @endrole

@endsection
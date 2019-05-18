@extends('admin.layouts.app')

@section('title') Edit OPD @endsection

@section('content')

<div class="col-md-8">

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    
    <form
        enctype="multipart/form-data"
        class="bg-white shadow-sm p-3"
        action="{{ route('opd.update', ['id' => $opd->id]) }}"
        method="POST">
        @method('PUT')
        @csrf
        <label>Nama</label><br>
        <input
            type="text"
            class="form-control {{$errors->first('nama') ? "is-invalid" : ""}}"
            value="{{ old('nama') ? old('nama') : $opd->nama }}"
            name="nama"
            placeholder="Nama OPD"/>
        <div class="invalid-feedback">
            {{ $errors->first('nama') }}
        </div>
        <br>
        <input
            type="submit"
            class="btn btn-primary"
            value="Save"/>
    </form>
</div>

@endsection
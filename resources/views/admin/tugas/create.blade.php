@extends('layouts/app')

@section('content')
         <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">
            <i class="fas fa-tasks mr-2"></i>  
            {{ $title }}
        </h1>

    <div class="card">
        <div class="card-header bg-primary">
                <a href="{{ route('tugas') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
        </div>
        <div class="card-body">
            <form action="{{ route('tugasStore') }}" method="post">
                @csrf
                <div class="row mb-2">
                <div class="col-xl-12 mb-1">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Nama</label>
                    <select name="user_id" class="form-control @error('user_id')
                    is-invalid @enderror" value="{{ old('jabatan') }}">
                        <option selected disabled>-- Pilih Nama  --</option>
                        @foreach ($user as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                @error('user_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-xl-12 mb-1">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Tugas</label>
                        <div>
                            <textarea name="tugas" rows="5" class="form-control"></textarea>
                    @error('tugas')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                        </div>
                        
                </div>
            </div>
            
            <div class="row mb-2">
                <div class="col-xl-6 mb-1">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Tanggal Mulai</label>
                        <div>
                            <input type="date" name="tanggal_mulai" class="form-control">
                    @error('tanggal_mulai')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                        </div>
                        
                </div>
                <div class="col-xl-6 mb-1">
                    <label class="form-label">
                        <span class="text-danger">*</span>
                        Tanggal Selesai</label>
                        <div>
                            <input type="date" name="tanggal_selesai" class="form-control">
                    @error('tanggal_selesai')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                        </div>
                        
                </div>
            </div>
            
            <div>
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    Simpan
                </button>
            </div>
        </form>    
        </div>
    </div>
@endsection
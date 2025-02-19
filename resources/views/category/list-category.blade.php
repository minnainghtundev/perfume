@extends('layouts.admin')
@section('content')


<div class="container mt-5">
    <div class="row">
        <!-- Add New Perfume -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-header text-center text-white" style="background: linear-gradient(135deg, #ff9a9e, #fad0c4); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="fw-bold mb-0">Add New Perfume</h5>
                </div>
                <div class="card-body" style="background-color: #fffaf0; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <form action="{{ url('/admin/category/add') }}" method="POST" enctype="multipart/form-data">
                        @csrf 

                        <!-- Perfume Name -->
                        <div class="mb-4">
                            <label for="name" class="form-label fw-semibold text-muted">Perfume Name</label>
                            <input type="text" name="name" class="form-control shadow-sm" placeholder="Ex: Dior Sauvage" style="border-radius: 10px;">
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Photo Upload -->
                        <div class="mb-4">
                            <label for="photo" class="form-label fw-semibold text-muted">Upload Photo</label>
                            <input type="file" name="photo" class="form-control shadow-sm" style="border-radius: 10px;">
                            @error('photo')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Remark -->
                        <div class="mb-4">
                            <label for="remark" class="form-label fw-semibold text-muted">Remark</label>
                            <input type="text" name="remark" class="form-control shadow-sm" placeholder="E.g., Best Seller, Limited Edition" style="border-radius: 10px;">
                            @error('remark')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn text-white" style="background: linear-gradient(135deg, #ff758c, #ff7eb3); border-radius: 10px;">
                                <i class="fas fa-plus-circle"></i> Add Perfume
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    
        <!-- Category List -->

        <div class="col-md-8">
            <div class="card shadow-lg border-0" style="border-radius: 15px;">
                <div class="card-header text-center text-white" style="background: linear-gradient(135deg, #ff9a9e, #fad0c4); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="fw-bold mb-0">Perfume List</h5>
                </div>
                <div class="card-body" style="background-color: #fffaf0; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Perfume Name</th>
                                    <th>Photo</th>
                                    <th>Remark</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <!-- Example Row -->
                            @foreach($categories as $category)
                            <tr>                                
                                <td> {{ $category->id }}</td>
                                <td> {{ $category->name }}</td>
                                <td> 
                                    <img width="50px" height="50px" src="{{ url("images/category/$category->photo") }}"> 
                                    
                                </td>
                                <td> {{ $category->remark }}</td>
                                <td class="text-center"> 
                                    <a href="{{ url("/admin/category/del/{$category->id}") }}" class="btn btn-danger btn-sm me-2"><i class="fas fa-trash-alt"></i>
                                    
                                    </a>
                                    
                                    <a href="{{ url("/admin/category/upd/{$category->id}") }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i>
                                        
                                    </a>
                                </td>                          
                            </tr>
                            @endforeach
                                <!-- Add more rows dynamically with Laravel -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>

@endsection


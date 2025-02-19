@extends('layouts.admin')
@section('content')

<div class="container mt-3">

    <div class="row">
        <!-- Add New Perfume -->
    <div class="col-md-4">
        <div class="card shadow-lg border-0" style="border-radius: 15px;">
            <div class="card-header text-center text-white" style="background: linear-gradient(135deg, #ff9a9e, #fad0c4); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="fw-bold mb-0">Add New Perfume</h5>
            </div>
            <div class="card-body" style="background-color: #fffaf0; border-bottom-left-radius: 15px; border-bottom-right-radius: 15px;">
                <form action="{{ url('/admin/item/add') }}" method="POST" enctype="multipart/form-data">
                    @csrf 

                     <!-- Brand Name -->
                     <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-muted"> Perfume Brand</label>
                        <select type="text" name="category_id" class="form-control" style="border-radius: 10px;">
                            @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->name}}
                            </option>
                            @endforeach;
                        @error('category_id')
                            <div style="color: red;">{{ $message }}</div>
                        @enderror
                        </select>
                    </div>

                    <!-- Perfume Name -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-muted">Product</label>
                        <input type="text" name="name" class="form-control shadow-sm" placeholder="Ex:Chanel De Bleu ( 30ml )" style="border-radius: 10px;">
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

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-muted">Price</label>
                        <input type="text" name="price" class="form-control shadow-sm" placeholder="Ex:000000" style="border-radius: 10px;">
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Qty -->
                    <div class="mb-4">
                        <label for="name" class="form-label fw-semibold text-muted">Qty</label>
                        <input type="text" name="qty" class="form-control shadow-sm" placeholder="Ex: 000" style="border-radius: 10px;">
                        @error('name')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Gender Dropdown -->
                    <div class="mb-4">
                        <label for="gender" class="form-label fw-semibold text-muted">Gender</label>
                        <select name="gender" class="form-select shadow-sm" style="border-radius: 10px;">
                            <option value="men">Men</option>
                            <option value="women">Women</option>
                            <option value="unisex">Unisex</option>
                        </select>
                        @error('gender')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="remark" class="form-label fw-semibold text-muted">Status</label>
                        <input type="text" name="status" class="form-control shadow-sm" placeholder="E.g., Best Seller, Limited Edition" style="border-radius: 10px;">
                        @error('remark')
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
                                <th>Perfume Brand</th>
                                <th>Product</th>
                                <th>Photo</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Gender</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th class="text-center">Actions</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                            <tr>                                
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->category->name}}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <img width="50px" height="50px" src="{{ url("images/item/$item->photo") }}">
                                </td>
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->gender }}</td>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->remark }}</td>
                                <td class="text-center">
                                    <a href="{{ url("/admin/item/del/{$item->id}") }}" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                    <a href="{{ url("/admin/item/upd/{$item->id}") }}" class="btn btn-warning btn-sm"> <i class="fas fa-edit"></i>  </a>
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
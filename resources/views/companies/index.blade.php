@extends('layouts.app')

@section('content')
<style>
    .table-responsive {
        overflow-x: auto;
    }
    a:hover {
    text-decoration: underline;
    }
    .popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.popup-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    animation-name: fadeIn;
    animation-duration: 0.5s;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(-50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

 

</style>

    <div class="card">
                @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
                @endif
        <div class="card-header">{{ __('Add Company') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('companies.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="logo" class="col-md-4 col-form-label text-md-right">{{ __('Logo') }}</label>

                    <div class="col-md-6">
                        <input id="logo" type="file" class="form-control-file @error('logo') is-invalid @enderror" name="logo" accept="image/png, image/jpeg">

                        @error('logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="website" class="col-md-4 col-form-label text-md-right">{{ __('Website') }}</label>

                    <div class="col-md-6">
                        <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ old('website') }}" autocomplete="website">

                        @error('website')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Add Company') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="container mt-4">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SR&nbsp;#</th>
                                    <th scope="col">Company&nbsp;Name</th>
                                    <th scope="col">Company&nbsp;email</th>
                                    <th scope="col">Company&nbsp;logo</th>
                                    <th scope="col">Company&nbsp;Website</th>
                                    <th scope="col" colspan="2" class="text-center">Others</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php $sr = 1 @endphp
                                    @foreach($companies as $comp)
                                <tr>
                                   
                                    <th scope="row">{{$sr}}</th>
                                    <td>{{$comp->name}}</td>
                                    <td>{{$comp->email}}</td>
                                    <td><img src="{{ asset('storage/logos/' . $comp->logo) }}" width="30%" height="30%" alt="Company Logo"> {{$comp->logo}}</td>
                                    <td><a href="{{$comp->website}}" style="color: blue; text-decoration: none;">{{$comp->website}}</a></td>
                                     <td>
                                        <button onclick="openPopup('{{ $comp->id }}', '{{ $comp->name }}', '{{ $comp->email }}')" class="btn btn-warning">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                    </td>
                                    <td>
                                        <form action="{{ route('companies.destroy', ['company' => $comp->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>Delete
                                            </button>
                                        </form>
                                    </td>


  
 
                                </tr>
                                @php $sr++ @endphp

                                @endforeach
                             </tbody>
                        </table>
                    </div>
               
                </div>

    
                <div id="editPopup" class="popup">
                    <div class="popup-content">
                        <span class="close" onclick="closePopup()">&times;</span>
                        <form id="editForm" method="POST" action="{{ route('companies.update', ['company' => $comp->id]) }}">
                                        @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="edit-name">Company Name:</label>
                                <input type="text" id="edit-name" class="form-control" name="name" value="{{ $comp->name }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-email">Company Email:</label>
                                <input type="email" id="edit-email" class="form-control" name="email" value="{{ $comp->email }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>


           

                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (Session::has('success'))
                alert('{{ Session::get('success') }}');
            @endif
        });
    </script>
          

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            paging: true,
            pageLength: 10 
        });
    });
</script>
 
 
<script>
    function openPopup(compId, compName, compEmail) {
    document.getElementById("editPopup").style.display = "block";
    document.getElementById("editForm").action = "/companies/" + compId; // Set the form action dynamically
    document.getElementById("edit-name").value = compName;
    document.getElementById("edit-email").value = compEmail;
}


    function closePopup() {
        document.getElementById("editPopup").style.display = "none";
    }
</script>

@endsection

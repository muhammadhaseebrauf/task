 
@extends('layouts.app')

@section('content')
 
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif
                    <div class="card-header">{{ __('Add Employee') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('employees.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                <div class="col-md-6">
                                    <select id="company_id" class="form-control @error('company_id') is-invalid @enderror" name="company_id" required>
                                        <option value="">Select Company</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('company_id')
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
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}">

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Employee') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4">
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">SR&nbsp;#</th>
                                    <th scope="col">First&nbsp;Name</th>
                                    <th scope="col">Last&nbsp;Name</th>
                                    <th scope="col">Company&nbsp;Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $sr = 1 @endphp
                                @foreach($employees as $emp)
                                <tr>
                                    @php 
                                    $company_name = \App\Models\Company::where('id', $emp->company_id)->select('name')->first();
                                    @endphp
                                    <th scope="row">{{$sr}}</th>
                                    <td>{{$emp->first_name}}</td>
                                    <td>{{$emp->last_name}}</td>
                                    @if($company_name)
                                        <td>{{ $company_name->name }}</td>
                                    @else
                                        <td>No company assigned</td>
                                    @endif
                                    <td>{{$emp->email}}</td>
                                    <td>{{$emp->phone}}</td>
                                   
                                </tr> 
                                @php $sr++ @endphp
                                @endforeach
                                    
                            </tbody>
                        </table>
                    </div>
               
    </div>
                
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#myTable').DataTable({
            responsive: true,
            paging: true,
            pageLength: 10
        });
    });
</script>

@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Preview') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Short description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->short_description }}" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Amount') }}</label>

                        <div class="col-md-6">
                            <input id="amount" type="number" min="0" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $product->amount }}" disabled>

                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                        <div class="col-md-6">
                            <input id="price" type="number" step="0.01" min="0" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" disabled>
                        </div>

                    </div>

                    <div class="form-group row">
                        <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Categories') }}</label>

                        <div class="col-md-6">
                            @foreach($categories as $category)
                            <option>
                                <input type="checkbox" value="{{ $category }}" checked disabled> {{ $category }}
                            </option>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group row justify-content-center">
                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $product->img_path) }}" alt="">
                        </div>
                    </div>

                </div>

            </div>
            <div class="card">
                <div class="card-body">
                    <div class="card-header">{{ __('Description') }}</div>
                    <?php echo $product->description ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
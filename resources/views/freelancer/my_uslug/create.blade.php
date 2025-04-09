@extends('layout.app')

@section('title-block', 'Добавить услугу')

@section('main_content')
<div class="add-service-container">
    <h1 class="add-service-title">Добавить новую услугу</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.store') }}" method="POST" class="add-service-form" enctype="multipart/form-data">
        @csrf

        <label for="title">Название услуги:</label>
        <input type="text" id="title" name="title" required value="{{ old('title') }}">

        <label for="description">Краткое описание:</label>
        <textarea id="description" name="description" rows="3">{{ old('description') }}</textarea>

        <label for="long_description">Подробное описание:</label>
        <textarea id="long_description" name="long_description" rows="5">{{ old('long_description') }}</textarea>

        <label for="url">Ссылка (если есть):</label>
        <input type="url" id="url" name="url" value="{{ old('url') }}" placeholder="https://example.com">

        <label for="price">Цена:</label>
        <input type="number" id="price" name="price" step="0.01" required value="{{ old('price') }}">

        <label for="images">Фотографии:</label>
        <input type="file" name="images[]" id="images" multiple accept="image/*">

        <button type="submit" class="btn-add-service">Добавить услугу</button>
    </form>
</div>
@endsection

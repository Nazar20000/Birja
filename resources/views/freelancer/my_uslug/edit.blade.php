@extends('layout.app')

@section('title-block', 'Редактировать услугу')

@section('main_content')
<div class="edit-service-container">
    <h1 class="edit-service-title">Редактировать услугу</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('services.update', $service->id) }}" method="POST" class="edit-service-form" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label for="title">Название:</label>
        <input type="text" id="title" name="title" value="{{ old('title', $service->title) }}" required>

        <label for="description">Краткое описание:</label>
        <textarea id="description" name="description" rows="3">{{ old('description', $service->description) }}</textarea>

        <label for="long_description">Подробное описание:</label>
        <textarea id="long_description" name="long_description" rows="5">{{ old('long_description', $service->long_description) }}</textarea>

        <label for="url">Ссылка:</label>
        <input type="url" id="url" name="url" value="{{ old('url', $service->url) }}">

        <label for="price">Цена:</label>
        <input type="number" id="price" name="price" step="0.01" value="{{ old('price', $service->price) }}" required>

        <label for="images">Добавить новые фото:</label>
        <input type="file" name="images[]" multiple accept="image/*">

        @if($service->images)
            <p>Загруженные изображения:</p>
            <div class="service-images">
                @foreach($service->images as $img)
                    <img src="{{ asset('storage/' . $img) }}" style="max-width: 100px; margin: 5px; border-radius: 6px;">
                @endforeach
            </div>
        @endif

        <div class="form-buttons">
            <button type="submit" class="btn-save">Сохранить изменения</button>
            <a href="{{ route('usluge') }}" class="btn-cancel">Отмена</a>
        </div>
    </form>
</div>
@endsection

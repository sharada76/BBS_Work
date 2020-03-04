@extends('layout')

@section('content')
<div class="container mt-4">
  <div class="border p-4">
    <h1 class="h5 mb-4">
      投稿の編集
    </h1>

    <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}">
      @csrf
      @method('PUT')

      <fieldset class="mb-4">
        <div class="form-group">
          <label for="title">
            タイトル
          </label>
          <input
          id="title"
          name="title"
          class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}"
          value="{{ old('title') ?: $post->title }}"
          type="text"
          >
          @if ($errors->has('title'))
          <div class="invalid-feedback">
            {{ $errors->first('title') }}
          </div>
          @endif
        </div>

        <div class="form-group">
          <label for="content">
            本文
          </label>

          <textarea
          id="content"
          name="content"
          class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"
          rows="4"
          >{{ old('content') ?: $post->content }}</textarea>
          @if ($errors->has('content'))
          <div class="invalid-feedback">
            {{ $errors->first('content') }}
          </div>
          @endif
        </div>

        <div class="mt-5">
          <a class="btn btn-secondary" href="{{ route('posts.show', ['post' => $post]) }}">
            キャンセル
          </a>

          <button type="submit" class="btn btn-primary">
            更新する
          </button>
        </div>
      </fieldset>
    </form>
  </div>
</div>
@endsection

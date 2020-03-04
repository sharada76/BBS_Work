@extends('layout')

@section('content')
<div class="container mt-4">
  <div class="border p-4">
    <div class="mb-4 text-right">
      <a class="btn btn-default" href="{{ route('posts.edit', ['post' => $post]) }}">
        編集する
      </a>
      <form
      style="display: inline-block;"
      method="POST"
      action="{{ route('posts.destroy', ['post' => $post]) }}"
      >
      @csrf
      @method('DELETE')

      <button class="btn btn-danger">削除する</button>
    </form>
  </div>
  <div class="mb-4 bg-light">
    <span class="h3">
      {{ $post->title }}
    </span>
    <span class="label label-default">
      <time class="h5">
        {{ $post->created_at->format('Y.m.d H:i') }}
        ({{ $post->name }})
      </time>
    </span>
  </div>

  <p class="mb-5">
    {!! nl2br(e($post->content)) !!}
  </p>

  <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
    @csrf

    <input
    name="post_id"
    type="hidden"
    value="{{ $post->id }}"
    >
    <h2 class="h5 mb-4">
      コメント
    </h2>
    <div class="form-group">
      <label for="name">
        名前
      </label>

      <textarea
      id="name"
      name="name"
      rows="1"
      class="form-control"
      >{{ old('name') }}</textarea>
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
      >{{ old('content') }}</textarea>
      @if ($errors->has('content'))
      <div class="invalid-feedback">
        {{ $errors->first('content') }}
      </div>
      @endif
    </div>

    <div class="mt-4">
      <button type="submit" class="btn btn-primary">
        コメントする
      </button>
    </div>
  </form>

  <section>
    @forelse($post->comments as $comment)
    <div class="border-top p-4">
      <time class="text-secondary">
        {{ $comment->created_at->format('Y.m.d H:i') }}
        ({{ $comment->name }})
      </time>
      <p class="mt-2">
        {!! nl2br(e($comment->content)) !!}
      </p>
      <div class="mb-4 text-right">
        <form
        style="display: inline-block;"
        method="POST"
        action="{{ route('comments.destroy', [$comment]) }}"
        >
        @csrf
        @method('DELETE')

        <button class="btn btn-default">削除する</button>
      </form>
    </div>
  </div>
  @empty
  <p>コメントはまだありません。</p>
  @endforelse
</section>
</div>
</div>
@endsection

@extends('layouts.main')

@section('content')
    <main class="blog">
        <div class="container">
            <h1 class="edica-page-title" data-aos="fade-up">Блог</h1>

            <section class="featured-posts-section">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-md-4 fetured-post blog-post" data-aos="fade-up">
                            <div class="blog-post-thumbnail-wrapper">
                                @if($post->preview_image)
                                    <img src="{{ asset('storage/' . $post->preview_image) }}" alt="blog post">
                                @else
                                    <img src="{{ asset('images/default.jpg') }}" alt="Нет изображения">
                                @endif
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-2">
                                <p class="blog-post-category">
                                    {{ $post->category->title ?? 'Без категории' }}
                                </p>

                                @auth
                                    <form action="{{ route('post.like.store', $post->id) }}" method="POST">
                                        @csrf
                                        <span>{{ $post->liked_users_count }}</span>
                                        <button type="submit" class="border-0 bg-transparent">
                                            @if(auth()->user()->likedPosts->contains($post->id))
                                                <i class="fas fa-heart text-danger"></i>
                                            @else
                                                <i class="far fa-heart"></i>
                                            @endif
                                        </button>
                                    </form>
                                @endauth

                                @guest
                                    <div>
                                        <span>{{ $post->liked_users_count }}</span>
                                        <i class="far fa-heart"></i>
                                    </div>
                                @endguest
                            </div>

                            <a href="{{ route('post.show', $post->id) }}" class="blog-post-permalink">
                                <h6 class="blog-post-title">{{ $post->title }}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>

                @if($posts->hasPages())
                    <div class="row">
                        <div class="mx-auto mt-4">
                            {{ $posts->links() }}
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </main>
@endsection

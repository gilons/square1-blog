@component('schema')
    "@type" : "Blog Post",
    "title" : {{isset($post) ? $post->title: 'Square1 Blog Post'}},
    "description" : {{isset($post) ? $post->content: ''}},
@endcomponent

@extends('layouts.main')
@section('title', isset($post) ? $post->title: 'Square1 Blog Post')
@section('description', isset($post) ? $post->content: '')

@section('content',)
    <div id="app" class="w-full">
      <div class="post-page-container">
    <div class="post-item-container">
      <div class="text-2xl text-center font-semibold m-3 text-gray-800">
        {{ isset($post) ? $post->title:'' }}
      </div>
      <div class="italic text-lg text-gray-500 self-start m-3">
        By {{ isset($post) && isset($post->user) ? $post->user->name:'' }} on {{isset($post) ? date('d-m-Y', strtotime($post->created_at)):'' }}
      </div>
      <div class="text-xl m-3">{!!isset($post) ? $post->content:'' !!}</div>
    <extra-posts hard />
    </div>
  </div>
    </div>
@endsection
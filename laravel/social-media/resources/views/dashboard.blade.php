<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                       <!-- Button to go to post creation page -->
                       <a href="{{ url('posts/index.html') }}" class="btn btn-primary mt-4">Create a New Post</a>
                    <br>
                    <h3>Your Post:</h3>
                    <br>
                    <!-- Display the posts here -->
                    @if ($posts->isEmpty())
                        <p>No posts yet.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($posts as $post)
                                <li class="list-group-item">
                                    <p>{{ $post->content }}</p>
                                    <small>By {{ $post->user->name }} on {{ $post->created_at->format('d-m-Y H:i') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

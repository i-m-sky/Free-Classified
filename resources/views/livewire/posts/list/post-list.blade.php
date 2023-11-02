<div>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <livewire:posts.post-single key="post-single-{{ now()->timestamp }}" :post="$post" :catRow="$catRow" :catNav="$catNav" />
        @endforeach
    @else
        <div>
            No result found.
        </div>
    @endif
</div>

<div>
    @if (!empty($posts) && count($posts) > 0)
        <hr>
        <div class="interested-product">
            <h5>You may be interested</h5>
            @foreach ($posts as $post)
                <livewire:posts.post-single key="post-single-{{ now()->timestamp }}" :post="$post" :catRow="$catRow"
                    :catNav="$catNav" />
            @endforeach
        </div>
        <hr class="mt-5">
    @endif
</div>

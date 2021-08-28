@php
    $ratings = $currentItem->getRating('all');
@endphp
<div class="comment-box">
    @include('path.comment_box',['map_table' => 'posts'])
</div>
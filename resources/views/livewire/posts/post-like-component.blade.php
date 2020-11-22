<div>
    <span>
        <button wire:click="doLike">
        <i class="{{ $liked ? 'fas fa-heart':'far fa-thumbs-up'}}"></i>
            {{$count}}
        </button>
    </span>
</div>

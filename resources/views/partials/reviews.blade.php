@forelse($ratings as $rating)
<div class="border-b pb-4">
    <div class="flex justify-between items-start mb-2">
        <p class="text-base md:text-lg card-h1 font-semibold">{{ $rating->user->name }}</p>
        <span class="text-yellow-400">
            @for($i = 1; $i <= 5; $i++)
                @if($i <= $rating->rating) ★ @else ☆ @endif
            @endfor
        </span>
    </div>
    <p class="text-base md:text-lg card-h1 mb-1">{{ $rating->review_text }}</p>
    <p class="text-xs text-[var(--tercero-oscuro)]">{{ $rating->created_at->format('d/m/Y H:i') }}</p>
</div>
@empty
<div class="text-center py-4">
    <p class="text-[var(--tercero-oscuro)]">No hay opiniones todavía.</p>
</div>
@endforelse
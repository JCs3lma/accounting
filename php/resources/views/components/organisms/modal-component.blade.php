@props([
    'header' => null,
    'headerClass' => '',
])
<div
    {{$attributes->merge([
        'class' => 'hidden absolute inset-0 py-12 px-6 justify-center z-100002 h-full',
        'id' => 'modal',
        'role' => 'dialog',
        'aria-modal' => 'true',
    ])->twMerge()}}
>
    <div class="absolute inset-0 bg-back-drop" aria-description="modal overlay" data-modal-close></div>
    <div class="max-w-[465px] relative w-full max-h-full z-[2] flex flex-col gap-2 items-end">
        <x-button
            variant="close"
            class="rounded-[3px] w-8 h-8 p-0 cursor-pointer flex items-center justify-center"
            data-modal-close
        >
            <x-close-icon />
        </x-button>
        <x-card class="rounded-sm w-full">
            @if(isset($header))
                <x-card-header class="p-0 pb-3 {{$headerClass}}">{{$header ?? ''}}</x-card-header>
            @endif
            {{$slot ?? ''}}
        </x-card>
    </div>
</div>

@push('js')
    <script>
        (function() {
            document.querySelectorAll('[data-modal-open]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const modal = document.getElementById('{{$attributes['id'] ?? 'modal'}}');
                    if (!modal) return;

                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                    document.body.classList.add('overflow-hidden');
                });
            });

            document.querySelectorAll('[data-modal-close]').forEach((btn) => {
                btn.addEventListener('click', () => {
                    const modal = btn.closest('#'+'{{$attributes['id'] ?? 'modal'}}');
                    if (!modal) return;

                    modal.classList.remove('flex');
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                });
            });
        })({});
    </script>
@endpush

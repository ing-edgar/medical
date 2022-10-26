<div class="flex justify-between items-center text-lg px-2">
    <slot name="left-actions" />

    <h1 class="text-xl font-semibold text-center">
        <slot name="modal-title" />
    </h1>
    <div class="space-x-4">
        <slot name="right-actions" />
    </div>
</div>

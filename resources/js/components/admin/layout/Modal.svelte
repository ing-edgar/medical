<script>
    export let width = 'w-2/5'
</script>

<div
    class="bg-slate-800 bg-opacity-50 flex justify-center items-center absolute top-0 right-0 bottom-0 left-0"
>
    <div class="bg-white p-2 rounded-md text-center {width} max-h-96">
        <slot />
    </div>
</div>

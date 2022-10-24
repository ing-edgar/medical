<script>
    import Sidebar from "./Sidebar.svelte";
</script>

<div class="grid grid-cols-[65px_minmax(900px,_1fr)] h-screen bg-gray-100">
    <Sidebar />
    <div class="flex-none bg-gray-100 p-4 w-full space-y-2 border">
        <div class="p-2">
            <h1 class="font-semibold text-2xl">
                <slot name="title" />
            </h1>
        </div>
        <slot />
    </div>
</div>

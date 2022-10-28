<script>
    import Sidebar from "./Sidebar.svelte";
</script>

<svelte:head>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet">
</svelte:head>
<div
    class="grid grid-cols-[65px_minmax(900px,_1fr)] h-screen bg-gray-100 font-sans"
>
    <Sidebar />
    <div class="flex-none w-full space-y-2 border">
        <div class="px-4 py-2">
            <h1 class="font-semibold text-2xl">
                <slot name="title" />
            </h1>
        </div>
        <div class="px-4">
            <slot />
        </div>
    </div>
</div>

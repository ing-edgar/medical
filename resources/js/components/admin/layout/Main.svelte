<script>
import Sidebar from './Sidebar.svelte';
</script>

<div class="flex flex-row h-screen bg-gray-100">
    <Sidebar></Sidebar>
    <div class="w-64 flex-none bg-gray-100 p-4 flex flex-col space-y-4">
        <div class="">
            <h1 class="font-semibold text-2xl">
                <slot name="title"></slot>
            </h1>
        </div>
        <slot></slot>
    </div>
</div>

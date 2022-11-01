<script>
    export let count;
</script>

{#if count}
    <div class="px-2 border rounded-full mt-4 bg-green-200 text-green-700">
        {count} cita{count>1?'s':''} para este día
    </div>
{/if}

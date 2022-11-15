<script>
    import {onDestroy, onMount} from "svelte";

    onDestroy(() => document.body.removeAttribute('style'));

    onMount(() => document.body.style = 'overflow:hidden;');
</script>

<div class="modal">
    <div class="content">
        <slot name="toolbar"></slot>
        <div id="main" class="main">
            <slot></slot>
        </div>
    </div>
</div>

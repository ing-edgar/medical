<script>
    import CircleButton from "@/components/admin/html/interactions/CircleButton.svelte";
    import {faXmark} from "@fortawesome/free-solid-svg-icons";
    import {view} from "@/services/view";

    export let component = null;
</script>

<div class="toolbar">
    <div class="left-window-buttons">
        <CircleButton icon={faXmark} class="circle-button text-close" on:click={()=>$view.component = component}>
        </CircleButton>
    </div>
    <slot name="title"></slot>
    <div class="right-window-buttons">
        <slot></slot>
    </div>
</div>

<script>
    import CircleButton from "@/components/admin/html/interactions/CircleButton.svelte";
    import {faXmark, faAngleLeft} from "@fortawesome/free-solid-svg-icons";
    import {view} from "@/services/view";

    export let backComponent;
</script>

<div class="toolbar">
    <div class="left-window-buttons">
        <CircleButton icon={faAngleLeft} class="circle-button text-close"
                      on:click={()=>$view.component = backComponent}>
        </CircleButton>
    </div>

    <slot name="title"></slot>
    <div class="right-window-buttons">
        <slot></slot>
    </div>
</div>
